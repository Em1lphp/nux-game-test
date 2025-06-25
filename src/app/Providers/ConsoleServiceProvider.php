<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(Schedule $schedule): void
    {
        $schedule->command('app:deactivate-link-command')->everyMinute();
    }
}
