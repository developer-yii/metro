<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule app:get-offers command every night at 11:55 PM Spain time
        $schedule->command('app:get-offers')->dailyAt('23:55')->timezone('Europe/Madrid');

        // Schedule app:get-lowest-offer-price command every 3 hours without overlapping, starting from 2 AM to 9 PM
        $schedule->command('app:get-update-lowest-offer-price')->timezone('Europe/Madrid')->withoutOverlapping()->everyThirtyMinutes()->between('2:00', '21:00');

        // Schedule joblogs:delete command every day at 01:00
        $schedule->command('joblogs:delete')->dailyAt('01:00')->timezone('Europe/Madrid');

        // Price update log clear every day at 03:00
        $schedule->command('app:delete-price-update-log')->dailyAt('03:00')->timezone('Europe/Madrid');

        // Schedule laravel log:rename command every monday at 00:30
        // $schedule->command('log:rename')->weekly()->mondays()->at('00:30')->timezone('Europe/Madrid');

        // Schedule laravel log:remove command every tuesday at 00:40
        // $schedule->command('log:remove-old')->weekly()->tuesdays()->at('00:40')->timezone('Europe/Madrid');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
