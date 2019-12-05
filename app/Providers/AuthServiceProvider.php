<?php

namespace App\Providers;

use App\Models\Coefficient;
use App\Models\Purchase;
use App\Policies\CoefficientPolicy;
use App\Policies\PurchasePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Coefficient::class => CoefficientPolicy::class,
        Purchase::class    => PurchasePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
