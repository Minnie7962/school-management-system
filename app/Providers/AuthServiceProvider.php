<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-dashboard', function ($user) {
            return in_array($user->role, ['admin', 'teacher', 'student', 'owner']);
        });

        // Other policies can be defined here
    }
}
