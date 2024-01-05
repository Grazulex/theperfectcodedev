<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\ConnectedAccount;
use App\Models\Page;
use App\Models\Team;
use App\Models\User;
use App\Policies\ConnectedAccountPolicy;
use App\Policies\PagePolicy;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        ConnectedAccount::class => ConnectedAccountPolicy::class,
        Page::class => PagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        if('production' === config('app.env')) {
            Gate::define('viewPulse', fn(User $user) => 'jms@grazulex.be' === $user->email);
        }



    }
}
