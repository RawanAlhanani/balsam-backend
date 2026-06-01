<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPresident
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // For simplicity and since we use Sanctum with multiple guards or custom logic
        // We check the authenticated user from the request
        $user = $request->user();

        if (!$user || $user->role !== 'president') {
            return response()->json(['message' => 'غير مسموح لك بالدخول. هذه الصلاحية خاصة بالرئيس فقط.'], 403);
        }

        return $next($request);
    }
}
