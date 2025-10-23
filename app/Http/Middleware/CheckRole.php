<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!isset($user->role) || $user->role !== $role) {
            return response()->json(['message' => 'Forbidden: Anda bukan admin'], 403);
        }

        return $next($request);
    }
}