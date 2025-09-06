<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles  // قائمة الأدوار المسموح بها
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$type)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        if (!in_array($user->type, $type)) {
            return response()->json(['message' => __('ليس لديك صلاحية للوصول إلى هذا الداتا')], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
