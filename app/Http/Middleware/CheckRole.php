<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect based on user role
        return $this->verifyRoleRedirect($user);
    }

    protected function verifyRoleRedirect($user)
    {
        $roleRoutes = [
            'admin' => 'admin.dashboard',
            'student' => 'student.dashboard',
            'teacher' => 'teacher.dashboard',
            'owner' => 'owner.dashboard',
        ];

        $route = $roleRoutes[$user->role] ?? 'login';
        return redirect()->route($route)->with('error', 'Unauthorized access');
    }

}
