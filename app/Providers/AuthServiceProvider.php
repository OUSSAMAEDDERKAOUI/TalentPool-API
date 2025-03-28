<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\user;
use App\Models\Annonce;
use App\Models\Candidature;
use App\Policies\AnnoncePolicy;
use App\Policies\CandidaturePolicy;
use App\Policies\StatistiquesPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Candidature::class => CandidaturePolicy::class,
        Annonce::class=>AnnoncePolicy::class,
        User::class => StatistiquesPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
