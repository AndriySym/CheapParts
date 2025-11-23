import { useState, useRef, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { chatAPI, productsAPI } from '../lib/api';

interface Message {
  role: 'user' | 'assistant';
  content: string;
}

interface Product {
  id: number;
  name: string;
  brand: string;
  category: string;
  price_cents: number;
  stock: number;
  image_url: string;
}

export default function Chat() {
  const [isOpen, setIsOpen] = useState(false);
  const [messages, setMessages] = useState<Message[]>([
    {
      role: 'assistant',
      content: '¡Hola! 👋 Soy tu asistente virtual de CheapParts. ¿En qué puedo ayudarte hoy? Puedo ayudarte a encontrar productos, responder preguntas sobre componentes de PC y más.',
    },
  ]);
  const [input, setInput] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const [detectedProducts, setDetectedProducts] = useState<Record<number, Product>>({});
  const messagesEndRef = useRef<HTMLDivElement>(null);
  const inputRef = useRef<HTMLInputElement>(null);

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages]);

  useEffect(() => {
    if (isOpen && inputRef.current) {
      inputRef.current.focus();
    }
  }, [isOpen]);

  const handleSend = async () => {
    if (!input.trim() || isLoading) return;

    const userMessage = input.trim();
    setInput('');
    setMessages((prev) => [...prev, { role: 'user', content: userMessage }]);
    setIsLoading(true);

    try {
      const response = await chatAPI.sendMessage(userMessage, messages);
      const newMessages = response.data.conversation_history.map((msg: any) => ({
        role: msg.role,
        content: msg.content,
      }));
      setMessages(newMessages);
      
      // Detectar y buscar productos en la última respuesta del asistente
      const lastAssistantMessage = newMessages.filter((m: Message) => m.role === 'assistant').pop();
      if (lastAssistantMessage) {
        // Buscar productos inmediatamente
        detectAndFetchProducts(lastAssistantMessage.content);
      }
    } catch (error: any) {
      console.error('Chat error:', error);
      const errorMessage = error.response?.data?.message 
        || error.response?.data?.error 
        || error.message 
        || 'Lo siento, hubo un error al procesar tu mensaje. Por favor, verifica que la API key de Google AI esté configurada correctamente.';
      
      setMessages((prev) => [
        ...prev,
        {
          role: 'assistant',
          content: `❌ Error: ${errorMessage}`,
        },
      ]);
    } finally {
      setIsLoading(false);
    }
  };

  const handleKeyPress = (e: React.KeyboardEvent) => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      handleSend();
    }
  };

  // Función para detectar y buscar productos mencionados en el mensaje
  const detectAndFetchProducts = async (content: string) => {
    // Patrón para detectar productos: busca nombres de productos en negrita
    // El chatbot suele mencionar productos con formato: "**Nombre (Marca) - Categoría - Precio**"
    const productPattern = /\*\*([^*]+)\*\*/g;
    const matches = Array.from(content.matchAll(productPattern));
    
    const productSearches: Array<{ text: string; name: string; brand?: string }> = [];
    matches.forEach(match => {
      const productText = match[1].trim();
      // El formato es: "Nombre (Marca) - Categoría - Precio"
      // Extraer el nombre del producto (antes del primer paréntesis o guión)
      let name = productText;
      let brand: string | undefined;
      
      // Buscar marca entre paréntesis
      const brandMatch = productText.match(/^([^(]+?)\s*\(([^)]+)\)/);
      if (brandMatch) {
        name = brandMatch[1].trim();
        brand = brandMatch[2].trim();
      } else {
        // Si no hay paréntesis, buscar hasta el primer guión
        const dashMatch = productText.match(/^([^-]+?)(?:\s*-\s*|$)/);
        if (dashMatch) {
          name = dashMatch[1].trim();
        }
      }
      
      if (name && name.length > 1) {
        productSearches.push({ text: productText, name, brand });
        console.log('Producto extraído:', { text: productText, name, brand });
      }
    });

    // Buscar productos que coincidan (evitar duplicados)
    const foundProductIds = new Set<number>();
    
    for (const search of productSearches) {
      try {
        // Normalizar el nombre de búsqueda (eliminar "32GB (2x16GB)" y similares)
        const normalizedSearchName = search.name
          .replace(/\s*\(2x\d+GB\)/gi, '')
          .replace(/\s*\(\d+x\d+GB\)/gi, '')
          .trim();
        
        // Si ya encontramos este producto, saltarlo
        const alreadyFound = Array.from(foundProductIds).some(id => {
          const existingProduct = Object.values(detectedProducts).find(p => p.id === id);
          if (!existingProduct) return false;
          const existingName = existingProduct.name.toLowerCase();
          const searchName = normalizedSearchName.toLowerCase();
          return existingName === searchName || existingName.includes(searchName) || searchName.includes(existingName);
        });
        
        if (alreadyFound) {
          console.log('Producto ya detectado, saltando:', normalizedSearchName);
          continue;
        }
        
        // Buscar por nombre primero (sin filtro de stock para encontrar más productos)
        let response = await productsAPI.getAll({ q: normalizedSearchName });
        // La API devuelve { data: [...], current_page, etc. } o directamente un array
        const products = Array.isArray(response.data) ? response.data : (response.data.data || []);
        
        // Buscar el producto que mejor coincida
        let product = products.find((p: Product) => {
          // Si ya tenemos este producto, saltarlo
          if (foundProductIds.has(p.id)) return false;
          
          const pName = p.name.toLowerCase();
          const searchName = normalizedSearchName.toLowerCase();
          const searchWords = searchName.split(/\s+/).filter(w => w.length > 2); // Palabras significativas
          
          // Coincidencia exacta
          if (pName === searchName) return true;
          
          // Coincidencia parcial - todas las palabras importantes deben estar
          const allWordsMatch = searchWords.every(word => pName.includes(word));
          if (allWordsMatch) return true;
          
          // Coincidencia por palabras clave importantes (marca + modelo)
          const hasBrand = search.brand && p.brand.toLowerCase().includes(search.brand.toLowerCase());
          const hasModel = searchWords.some(word => pName.includes(word));
          if (hasBrand && hasModel) return true;
          
          return false;
        });
        
        // Si no encontramos, buscar por marca y palabras clave
        if (!product && search.brand) {
          response = await productsAPI.getAll({ q: search.brand });
          const brandProducts = Array.isArray(response.data) ? response.data : (response.data.data || []);
          
          // Buscar por palabras clave del nombre en productos de la marca
          const searchWords = normalizedSearchName.toLowerCase().split(/\s+/).filter(w => w.length > 2);
          product = brandProducts.find((p: Product) => {
            // Si ya tenemos este producto, saltarlo
            if (foundProductIds.has(p.id)) return false;
            
            const pName = p.name.toLowerCase();
            const pBrand = p.brand.toLowerCase();
            const searchBrand = search.brand?.toLowerCase() || '';
            
            // Debe coincidir la marca
            if (!pBrand.includes(searchBrand) && !searchBrand.includes(pBrand)) return false;
            
            // Al menos 2 palabras clave deben coincidir
            const matchingWords = searchWords.filter(word => pName.includes(word));
            return matchingWords.length >= 2 || matchingWords.length >= searchWords.length * 0.5;
          });
        }
        
        if (product && !foundProductIds.has(product.id)) {
          foundProductIds.add(product.id);
          setDetectedProducts(prev => {
            const updated = {
              ...prev,
              [product.id]: product
            };
            console.log('Producto detectado:', product.name, 'ID:', product.id, 'Buscado:', search.name);
            return updated;
          });
        } else {
          console.log('Producto no encontrado:', search.name, 'Normalizado:', normalizedSearchName, search.brand);
        }
      } catch (error) {
        console.error('Error buscando producto:', error);
      }
    }
  };

  // Renderizar mensaje con productos detectados
  const renderMessage = (content: string) => {
    const parts: (string | React.ReactElement)[] = [];
    let lastIndex = 0;
    const renderedProductIds = new Set<number>(); // Para evitar renderizar el mismo producto múltiples veces
    
    // Limpiar el contenido primero: eliminar asteriscos de listas, stock y precios después de productos
    let cleanedContent = content
      // Eliminar asteriscos al inicio de líneas de listas
      .replace(/^\*\s+/gm, '')
      // Eliminar información de stock en varios formatos
      .replace(/\s*-\s*Stock:\s*\d+/gi, '')
      .replace(/\s*\(Stock:\s*\d+\)/gi, '')
      .replace(/\s*por\s+\d+\.\d+€\s*\(Stock:\s*\d+\)/gi, '')
      // Eliminar texto de formato "- Categoría - Precio€" que aparece después de productos mencionados
      .replace(/\s*-\s*[^-]+\s*-\s*\d+\.\d+€/g, '');
    
    // Buscar productos mencionados en el formato del chatbot (texto en negrita)
    const productPattern = /\*\*([^*]+)\*\*/g;
    let match;
    
    while ((match = productPattern.exec(cleanedContent)) !== null) {
      // Añadir texto antes del match (limpiando asteriscos)
      if (match.index > lastIndex) {
        let textBefore = cleanedContent.substring(lastIndex, match.index);
        // Limpiar asteriscos restantes
        textBefore = textBefore.replace(/^\*\s+/gm, '');
        if (textBefore.trim()) {
          parts.push(textBefore);
        }
      }
      
      // Extraer el texto del producto
      let productText = match[1].trim();
      
      // Extraer nombre del producto del texto (antes del paréntesis o guión)
      // El formato es: "Nombre (Marca) - Categoría - Precio"
      let productName = productText;
      const brandMatch = productText.match(/^([^(]+?)\s*\(([^)]+)\)/);
      if (brandMatch) {
        productName = brandMatch[1].trim();
      } else {
        // Si no hay paréntesis, buscar hasta el primer guión
        const dashMatch = productText.match(/^([^-]+?)(?:\s*-\s*|$)/);
        if (dashMatch) {
          productName = dashMatch[1].trim();
        }
      }
      
      // Normalizar el nombre (igual que en detectAndFetchProducts)
      const normalizedName = productName
        .replace(/\s*\(2x\d+GB\)/gi, '')
        .replace(/\s*\(\d+x\d+GB\)/gi, '')
        .trim();
      
      // Buscar si tenemos este producto en detectedProducts
      const foundProduct = Object.values(detectedProducts).find(p => {
        const pName = p.name.toLowerCase();
        const pBrand = p.brand.toLowerCase();
        const searchText = productText.toLowerCase();
        const searchName = normalizedName.toLowerCase();
        const searchWords = searchName.split(/\s+/).filter(w => w.length > 2);
        
        // Coincidencia exacta
        if (pName === searchName) return true;
        
        // Todas las palabras importantes deben estar
        const allWordsMatch = searchWords.every(word => pName.includes(word));
        if (allWordsMatch) return true;
        
        // Coincidencia por marca y palabras clave
        const brandMatch = searchText.includes(pBrand) || pBrand.includes(searchText.split(' ')[0]);
        const wordMatch = searchWords.some(word => pName.includes(word));
        if (brandMatch && wordMatch) return true;
        
        // Coincidencia parcial
        if (pName.includes(searchName) || searchName.includes(pName)) return true;
        
        return false;
      });
      
      console.log('Buscando producto en render:', normalizedName, 'Encontrado:', foundProduct?.name, 'Total detectados:', Object.keys(detectedProducts).length);
      
      if (foundProduct) {
        // Solo renderizar si no lo hemos renderizado ya
        if (!renderedProductIds.has(foundProduct.id)) {
          renderedProductIds.add(foundProduct.id);
          
          // Renderizar como card clicable
          parts.push(
            <div key={`product-${foundProduct.id}`} className="my-3 w-full">
              <Link
                to={`/products/${foundProduct.id}`}
                onClick={(e) => {
                  e.preventDefault();
                  e.stopPropagation();
                  setIsOpen(false);
                  window.location.href = `/products/${foundProduct.id}`;
                }}
                className="block w-full no-underline"
              >
                <div className="bg-blue-50 border-2 border-blue-200 rounded-lg p-3 hover:border-blue-400 hover:bg-blue-100 transition-all cursor-pointer w-full">
                  <div className="flex items-start gap-3">
                    {foundProduct.image_url && (
                      <div className="relative w-16 h-16 flex-shrink-0">
                        <img
                          src={`http://localhost:8000${foundProduct.image_url}`}
                          alt={foundProduct.name}
                          className="w-full h-full object-contain rounded"
                          onError={(e) => {
                            const target = e.target as HTMLImageElement;
                            target.style.display = 'none';
                          }}
                        />
                      </div>
                    )}
                    <div className="flex-1 min-w-0">
                      <div className="font-semibold text-blue-700 truncate">{foundProduct.name}</div>
                      <div className="text-xs text-gray-600">{foundProduct.brand}</div>
                      <div className="text-sm font-bold text-blue-600 mt-1">
                        {(foundProduct.price_cents / 100).toFixed(2)}€
                      </div>
                    </div>
                  </div>
                </div>
              </Link>
            </div>
          );
        }
        
        // Saltar el texto que viene después del producto (formato "- Categoría - Precio€")
        // Buscar hasta el siguiente producto o fin de línea
        const nextProductMatch = cleanedContent.substring(match.index + match[0].length).match(/^\s*-\s*[^-]+\s*-\s*\d+\.\d+€/);
        if (nextProductMatch) {
          lastIndex = match.index + match[0].length + nextProductMatch[0].length;
        } else {
          lastIndex = match.index + match[0].length;
        }
      } else {
        // Si no encontramos el producto, mostrar el texto con formato (sin asteriscos)
        // Pero intentar buscar el producto de nuevo con una búsqueda más amplia
        parts.push(
          <span key={match.index} className="text-blue-700 font-semibold">
            {productText}
          </span>
        );
        lastIndex = match.index + match[0].length;
      }
    }
    
    // Añadir texto restante (ya limpio)
    if (lastIndex < cleanedContent.length) {
      let remainingText = cleanedContent.substring(lastIndex);
      // Dividir por líneas para mantener el formato
      const lines = remainingText.split('\n');
      lines.forEach((line, idx) => {
        if (line.trim()) {
          parts.push(line);
          if (idx < lines.length - 1) {
            parts.push(<br key={`br-${lastIndex}-${idx}`} />);
          }
        } else if (idx < lines.length - 1) {
          parts.push(<br key={`br-empty-${lastIndex}-${idx}`} />);
        }
      });
    }
    
    return parts.length > 0 ? <>{parts}</> : <>{cleanedContent}</>;
  };

  return (
    <>
      {/* Botón flotante */}
      {!isOpen && (
        <button
          onClick={() => setIsOpen(true)}
          className="fixed bottom-6 right-6 bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-all transform hover:scale-110 z-50"
          aria-label="Abrir chat"
        >
          <svg
            className="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              strokeWidth={2}
              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
            />
          </svg>
        </button>
      )}

      {/* Ventana de chat */}
      {isOpen && (
        <div className="fixed bottom-6 right-6 w-96 h-[600px] bg-white rounded-lg shadow-2xl flex flex-col z-50 border border-gray-200">
          {/* Header */}
          <div className="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <div className="flex items-center gap-2">
              <div className="w-3 h-3 bg-green-400 rounded-full"></div>
              <h3 className="font-semibold">Asistente Virtual</h3>
            </div>
            <button
              onClick={() => setIsOpen(false)}
              className="text-white hover:text-gray-200 transition"
              aria-label="Cerrar chat"
            >
              <svg
                className="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>

          {/* Mensajes */}
          <div className="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            {messages.map((message, index) => (
              <div
                key={index}
                className={`flex ${message.role === 'user' ? 'justify-end' : 'justify-start'}`}
              >
                <div
                  className={`max-w-[80%] rounded-lg p-3 ${
                    message.role === 'user'
                      ? 'bg-blue-600 text-white'
                      : 'bg-white text-gray-800 border border-gray-200'
                  }`}
                >
                  {message.role === 'assistant' ? (
                    <div className="text-sm">
                      {renderMessage(message.content)}
                    </div>
                  ) : (
                    <p className="text-sm whitespace-pre-wrap">{message.content}</p>
                  )}
                </div>
              </div>
            ))}
            {isLoading && (
              <div className="flex justify-start">
                <div className="bg-white text-gray-800 rounded-lg p-3 border border-gray-200">
                  <div className="flex gap-1">
                    <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                    <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style={{ animationDelay: '0.1s' }}></div>
                    <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style={{ animationDelay: '0.2s' }}></div>
                  </div>
                </div>
              </div>
            )}
            <div ref={messagesEndRef} />
          </div>

          {/* Input */}
          <div className="p-4 border-t border-gray-200 bg-white rounded-b-lg">
            <div className="flex gap-2">
              <input
                ref={inputRef}
                type="text"
                value={input}
                onChange={(e) => setInput(e.target.value)}
                onKeyPress={handleKeyPress}
                placeholder="Escribe tu mensaje..."
                className="flex-1 px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition"
                disabled={isLoading}
              />
              <button
                onClick={handleSend}
                disabled={!input.trim() || isLoading}
                className="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center"
              >
                <svg
                  className="w-5 h-5 transform rotate-90"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      )}
    </>
  );
}

