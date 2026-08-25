<?php

namespace App\Http\Middleware;

use App\LoginAdmin;
use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $permission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'غير مسموح لك بالدخول. يجب تسجيل الدخول.'], 401);
        }

        if (!($user instanceof LoginAdmin)) {
            return response()->json(['message' => 'غير مسموح لك بالدخول. هذه الخدمة مخصصة لحسابات الإدارة فقط.'], 403);
        }

        // Check if user has the required permission
        if (!$user->hasPermission($permission)) {
            return response()->json(['message' => 'غير مسموح لك بالدخول. ليس لديك الصلاحيات الكافية.'], 403);
        }

        return $next($request);
    }
}
