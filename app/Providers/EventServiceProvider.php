<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Page;
use App\Models\PageComments;
use App\Models\Version;
use App\Observers\PageCommentsObserver;
use App\Observers\PageObserver;
use App\Observers\VersionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Page::observe(PageObserver::class);
        Version::observe(VersionObserver::class);
        PageComments::observe(PageCommentsObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
