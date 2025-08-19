<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Models\Feature;
use App\Policies\FeaturePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Feature::class => FeaturePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-blog', function (User $user) {
            \Log::info('Gate view-blog called for user: ' . $user->id);
            return app(FeaturePolicy::class)->viewAny($user, 'Blog');
        });
    }
}