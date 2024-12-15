<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

    
        if ($user && $user->is_banned  == true) {
            return response()->json([
                'message' => 'user access denied'
            ], 403);
        }

        // إذا كان المستخدم ليس محظورًا، تابع مع العملية التالية
        return $next($request);
    }
}
