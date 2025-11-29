<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'conversation_history' => 'sometimes|array',
        ]);

        $userMessage = $request->input('message');
        $conversationHistory = $request->input('conversation_history', []);

        // Obtener información de productos para el contexto
        $allProducts = Product::select('id', 'name', 'brand', 'category', 'price_cents', 'stock', 'description')
            ->where('stock', '>', 0)
            ->get();

        // Agrupar por categoría y tomar productos de cada categoría
        $productsByCategory = $allProducts->groupBy('category');
        $products = collect();
        
        // Tomar más productos de cada categoría para tener mejor contexto (especialmente los periféricos)
        foreach ($productsByCategory as $category => $categoryProducts) {
            // Tomar más productos de Peripherals ya que incluye muchos tipos diferentes
            $limit = $category === 'Peripherals' ? 30 : 15;
            $products = $products->merge($categoryProducts->take($limit));
        }
        
        // Si aún no tenemos suficientes, añadir más productos aleatorios
        if ($products->count() < 150) {
            $remaining = $allProducts->diff($products)->shuffle()->take(150 - $products->count());
            $products = $products->merge($remaining);
        }

        try {
            $apiKey = config('services.google_ai.api_key');
            
            if (!$apiKey) {
                return response()->json([
                    'error' => 'Google AI API key no configurada',
                    'message' => 'Por favor, configura GOOGLE_AI_API_KEY en las variables de entorno'
                ], 500);
            }

            // Construir el prompt completo con contexto
            $systemContext = $this->buildSystemContext($products);
            
            // Construir el historial de conversación
            $fullPrompt = $systemContext . "\n\n";
            
            // Añadir historial reciente (últimos 4 intercambios)
            $recentHistory = array_slice($conversationHistory, -8);
            foreach ($recentHistory as $msg) {
                if ($msg['role'] === 'user') {
                    $fullPrompt .= "Usuario: " . $msg['content'] . "\n\n";
                } else {
                    $fullPrompt .= "Asistente: " . $msg['content'] . "\n\n";
                }
            }
            
            // Añadir el mensaje actual
            $fullPrompt .= "Usuario: " . $userMessage . "\n\nAsistente:";

            // Listar modelos disponibles para encontrar uno que funcione
            $modelsListResponse = Http::timeout(10)->get(
                "https://generativelanguage.googleapis.com/v1beta/models?key=" . urlencode($apiKey)
            );
            
            $availableModel = null;
            if ($modelsListResponse->successful()) {
                $models = $modelsListResponse->json();
                if (isset($models['models'])) {
                    // Modelos a evitar (experimentales o que requieren billing)
                    $excludedModels = ['exp', 'experimental', '2.5', 'ultra'];
                    
                    // Buscar un modelo que soporte generateContent y esté en tier gratuito
                    foreach ($models['models'] as $model) {
                        if (isset($model['name']) && isset($model['supportedGenerationMethods'])) {
                            if (in_array('generateContent', $model['supportedGenerationMethods'])) {
                                $modelName = str_replace('models/', '', $model['name']);
                                
                                // Evitar modelos experimentales o que requieren billing
                                $isExcluded = false;
                                foreach ($excludedModels as $excluded) {
                                    if (str_contains(strtolower($modelName), $excluded)) {
                                        $isExcluded = true;
                                        break;
                                    }
                                }
                                
                                if (!$isExcluded) {
                                    // Priorizar modelos flash (más rápidos y en tier gratuito)
                                    if (str_contains($modelName, 'flash')) {
                                        $availableModel = $modelName;
                                        break;
                                    }
                                    // Luego modelos pro (si no hay flash)
                                    if (!$availableModel && str_contains($modelName, 'pro') && !str_contains($modelName, 'exp')) {
                                        $availableModel = $modelName;
                                    }
                                    // Si no hay flash/pro, usar el primero disponible que no sea experimental
                                    if (!$availableModel) {
                                        $availableModel = $modelName;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
            // Si no encontramos modelo, usar uno por defecto del tier gratuito
            if (!$availableModel) {
                $availableModel = 'gemini-1.5-flash';
            }
            
            Log::info("Usando modelo: {$availableModel}");
            
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$availableModel}:generateContent?key=" . urlencode($apiKey);
            
            // Intentar con reintentos para errores 429 (rate limit)
            $maxRetries = 3;
            $retryDelay = 2; // segundos
            $response = null;
            
            for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
                if ($attempt > 0) {
                    // Esperar antes de reintentar (backoff exponencial)
                    $waitTime = $retryDelay * pow(2, $attempt - 1);
                    Log::info("Reintentando solicitud a Google AI (intento {$attempt}/{$maxRetries}) después de {$waitTime} segundos...");
                    sleep($waitTime);
                }
                
                $response = Http::timeout(30)
                    ->withHeaders([
                        'Content-Type' => 'application/json',
                    ])
                    ->post($url, [
                        'contents' => [
                            [
                                'parts' => [
                                    [
                                        'text' => $fullPrompt
                                    ]
                                ]
                            ]
                        ],
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'topK' => 40,
                            'topP' => 0.95,
                            'maxOutputTokens' => 1024,
                        ],
                    ]);
                
                // Si la solicitud fue exitosa o no es un error 429, salir del loop
                if ($response->successful() || ($response->status() !== 429 && $attempt < $maxRetries)) {
                    break;
                }
            }

            if ($response->failed()) {
                $errorBody = $response->json();
                $statusCode = $response->status();
                $responseBody = $response->body();
                
                Log::error('Google AI API error', [
                    'status' => $statusCode,
                    'body' => $responseBody,
                    'error' => $errorBody
                ]);

                $errorMessage = 'Error al comunicarse con el servicio de IA';
                if (isset($errorBody['error']['message'])) {
                    $errorMessage = $errorBody['error']['message'];
                } elseif (isset($errorBody['error'])) {
                    $errorMessage = is_string($errorBody['error']) ? $errorBody['error'] : 'Error de API';
                }
                
                // Mensaje más específico según el error
                if ($statusCode === 429 || str_contains($errorMessage, 'Resource exhausted') || str_contains($errorMessage, 'quota')) {
                    $errorMessage = 'El servicio de IA está temporalmente sobrecargado o has alcanzado el límite de solicitudes. Por favor, espera unos momentos e intenta de nuevo. Si el problema persiste, verifica tu cuota en Google AI Studio.';
                } elseif ($statusCode === 404 || str_contains($errorMessage, 'not found')) {
                    $errorMessage = 'Modelo no encontrado. Verifica que tu API key tenga acceso a los modelos Gemini. Ve a https://aistudio.google.com/ para verificar.';
                } elseif ($statusCode === 403 || str_contains($errorMessage, 'permission') || str_contains($errorMessage, 'API key')) {
                    $errorMessage = 'API key inválida o sin permisos. Verifica tu API key en Google AI Studio.';
                }

                return response()->json([
                    'error' => 'Error al comunicarse con el servicio de IA',
                    'message' => $errorMessage,
                    'status_code' => $statusCode,
                ], $statusCode === 429 ? 429 : 500);
            }

            $data = $response->json();

            if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                Log::error('Google AI API unexpected response', [
                    'data' => $data,
                    'status' => $response->status()
                ]);
                
                $errorMsg = 'Respuesta inesperada del servicio de IA';
                if (isset($data['error'])) {
                    $errorMsg = $data['error']['message'] ?? 'Error desconocido';
                }
                
                return response()->json([
                    'error' => 'Respuesta inesperada del servicio de IA',
                    'message' => $errorMsg
                ], 500);
            }

            $aiResponse = $data['candidates'][0]['content']['parts'][0]['text'];

            return response()->json([
                'message' => $aiResponse,
                'conversation_history' => array_merge($conversationHistory, [
                    ['role' => 'user', 'content' => $userMessage],
                    ['role' => 'assistant', 'content' => $aiResponse]
                ])
            ]);

        } catch (\Exception $e) {
            Log::error('Chat error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Error al procesar tu mensaje',
                'message' => 'Por favor, intenta de nuevo más tarde.'
            ], 500);
        }
    }

    private function buildSystemContext($products)
    {
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->toArray();

        $brands = Product::select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->pluck('brand')
            ->toArray();

        // Agrupar productos por categoría
        $productsByCategory = $products->groupBy('category');
        $productList = '';
        
        // Incluir productos de cada categoría (sin mostrar descripción en el chat)
        foreach ($productsByCategory as $category => $categoryProducts) {
            $categoryList = $categoryProducts->map(function ($product) {
                return sprintf(
                    "- %s (%s) - %.2f€",
                    $product->name,
                    $product->brand,
                    $product->price_cents / 100
                );
            })->implode("\n");
            
            if ($categoryList) {
                $productList .= "\n{$category}:\n{$categoryList}\n";
            }
        }
        
        // Crear un diccionario de descripciones para referencia interna del AI (no se muestra en el chat)
        $productDescriptions = $products->map(function ($product) {
            return sprintf(
                "%s (%s): %s",
                $product->name,
                $product->brand,
                $product->description ?: 'Sin descripción'
            );
        })->implode("\n");
        
        return "Eres un asistente virtual de una tienda online de componentes de PC llamada 'CheapParts'. 

INFORMACIÓN DE LA TIENDA:
- Especializada en componentes de PC: CPUs, GPUs, RAM, almacenamiento, placas base, fuentes de alimentación, cajas, refrigeración, periféricos y monitores.
- Tu objetivo es ayudar a los clientes a encontrar los productos que necesitan.

CATEGORÍAS DISPONIBLES: " . implode(', ', $categories) . "

MARCAS DISPONIBLES: " . implode(', ', $brands) . "

PRODUCTOS DISPONIBLES (ejemplos):
{$productList}

DESCRIPCIONES DE PRODUCTOS (para referencia interna - NO las muestres al cliente):
{$productDescriptions}

INSTRUCCIONES:
1. Responde siempre en español de manera amigable y profesional.
2. IMPORTANTE: Usa la sección DESCRIPCIONES DE PRODUCTOS (arriba) para identificar si un producto coincide con lo que el cliente busca. Esta información es solo para tu referencia interna - NO la muestres al cliente. Por ejemplo, si piden auriculares gaming, busca en las descripciones productos que mencionen auriculares, headset, headphones, gaming, etc. Luego menciona solo el nombre, marca y precio del producto encontrado.
3. Cuando menciones productos, usa el formato: **Nombre del Producto (Marca)** - Categoría - Precio€ (ejemplo: **HyperX Cloud Alpha Wireless (HyperX)** - Peripherals - 199.99€).
4. NO menciones el stock de los productos, solo el nombre, marca, categoría y precio.
5. Si un cliente pregunta por un tipo de producto específico (auriculares, ratones, teclados, etc.), revisa TODAS las descripciones de productos en la categoría Peripherals para encontrar coincidencias. Los productos pueden tener nombres que no sean obvios, pero sus descripciones pueden indicar el tipo de producto.
6. Si no encuentras un producto específico en la lista, pero hay productos similares, menciónalos. Si realmente no hay nada relacionado, entonces recomienda usar los filtros de búsqueda.
7. Mantén las respuestas concisas pero informativas.
8. Si preguntan sobre precios, siempre menciona que los precios están en euros.
9. No inventes productos que no estén en la lista.";
    }

}
