<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
    if (!$request->user()) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }
    if ($request->user()->role === 'tenant') {
        return $next($request);
    }
    return response()->json(['message' => 'unauthorized'], 403);
    }
}
