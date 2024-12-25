<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Laravel's default middleware
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * The application's route middleware.
     *
     * These middleware can be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'check.role' => \App\Http\Middleware\CheckRole::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'teacher' => \App\Http\Middleware\TeacherMiddleware::class,
        'student' => \App\Http\Middleware\StudentMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'owner' => \App\Http\Middleware\OwnerMiddleware::class,
    ];

    /**
     * The priority-sorted middleware groups for the application.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Web middleware group
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // API middleware group
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}
