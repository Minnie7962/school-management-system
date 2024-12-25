<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        if ($this->hasPermission($userRole, $role)) {
            return $next($request);
        }

        return abort(403); // Forbidden
    }

    private function hasPermission($userRole, $requiredRole)
    {
        // Define role hierarchy
        $roles = [
            'admin' => ['admin', 'teacher', 'student'],
            'teacher' => ['teacher', 'student'],
            'student' => ['student']
        ];

        return in_array($userRole, $roles[$requiredRole] ?? []);
    }
}
