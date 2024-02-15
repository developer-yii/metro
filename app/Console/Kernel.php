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
        $schedule->command('app:get-update-lowest-offer-price')->timezone('Europe/Madrid')->withoutOverlapping()->everyThreeHours()->between('2:00', '21:00');
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
