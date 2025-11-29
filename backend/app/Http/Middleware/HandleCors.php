<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lista de orígenes permitidos
        $allowedOrigins = [
            'http://localhost:5173',
            'http://localhost:5174',
            'https://cheap-parts-frontend.onrender.com',
            env('FRONTEND_URL', 'http://localhost:5173'),
        ];

        $origin = $request->headers->get('Origin');
        
        // Si el origen está en la lista permitida o es null (misma origen)
        if ($origin && in_array($origin, $allowedOrigins)) {
            $response = $next($request);
            
            // Agregar headers CORS
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, Origin');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Max-Age', '86400');
            
            return $response;
        }

        // Manejar preflight requests (OPTIONS)
        if ($request->getMethod() === 'OPTIONS') {
            $response = response('', 200);
            
            if ($origin && in_array($origin, $allowedOrigins)) {
                $response->headers->set('Access-Control-Allow-Origin', $origin);
                $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
                $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, Origin');
                $response->headers->set('Access-Control-Allow-Credentials', 'true');
                $response->headers->set('Access-Control-Max-Age', '86400');
            }
            
            return $response;
        }

        return $next($request);
    }
}
