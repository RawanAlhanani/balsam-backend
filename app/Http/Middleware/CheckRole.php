<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // `staff` = any admin account regardless of role, including
        // president-defined custom roles whose access is decided purely by
        // the per-route `permission:` middleware.
        if (in_array('staff', $roles) && $user instanceof \App\LoginAdmin) {
            return $next($request);
        }

        if (!$user || !in_array($user->role, $roles)) {
            return response()->json(['message' => 'غير مسموح لك بالدخول. ليس لديك الصلاحيات الكافية.'], 403);
        }

        return $next($request);
    }
}
