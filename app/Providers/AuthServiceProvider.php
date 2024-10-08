<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Animal;
use App\Policies\AnimalPolicy;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Animal::class => AnimalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Passport::enablePasswordGrant();

            // access_token 設定核發後15天後過期
        Passport::tokensExpireIn(now()->addDays(15));

        // refresh_token 設定核發後30天後過期
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
