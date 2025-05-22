<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XAuthorization
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-Authorization');

        // Example hardcoded token check (replace with DB or config logic)
        $validToken = env('API_ACCESS_TOKEN', 'hello');

        if (!$token || $token !== $validToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
