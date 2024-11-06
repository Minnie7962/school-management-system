<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyRoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($request->user()->hasRole('owner')) {
            return redirect()->route('owner.dashboard');
        } elseif ($request->user()->hasRole('student')) {
            return redirect()->route('student.dashboard');
        } elseif ($request->user()->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
        }

        return $next($request);
    }
}
