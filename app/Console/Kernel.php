<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Override;

// @codeCoverageIgnoreStart
final class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    #[Override]
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    /**
     * Define the application's command schedule.
     */
    #[Override]
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }
}

// @codeCoverageIgnoreEnd
