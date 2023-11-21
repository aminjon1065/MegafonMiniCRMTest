<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            // Не авторизован, перенаправление на страницу входа
            return redirect('login');
        }

        $user = Auth::user();
        foreach ($roles as $role) {
            // Проверка на соответствие роли
            if ($user->role == $role) {
                return $next($request);
            }
        }

        // Если роль не соответствует, перенаправление на главную страницу или страницу ошибки
        return redirect('error-permission');

        return $next($request);
    }
}
