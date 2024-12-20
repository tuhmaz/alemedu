<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateDatabaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $database = $request->route('database');
        
        if (!in_array($database, ['jo', 'sa', 'eg', 'ps'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid database name'
            ], 400);
        }

        return $next($request);
    }
}
