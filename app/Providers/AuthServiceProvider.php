<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-directors', function (User $user) {
            return $user->role->name === 'admin';
        });

        Gate::define('manage-guards', function (User $user) {
            return $user->role->name === 'admin';
        });

        Gate::define('manage-prisoners', function (User $user) {
            return $user->role->name === 'admin';
        });

        Gate::define('manage-wards', function (User $user) {
            return $user->role->name === 'director';
        });

        Gate::define('manage-jails', function (User $user) {
            return $user->role->name === 'director';
        });
    }
}
