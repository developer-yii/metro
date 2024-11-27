<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PriceUpdateLog;
use Carbon\Carbon;

class DeletePriceUpdateLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-price-update-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete price update log older than 1 year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Calculate the date 1 year ago
        $oneYearAgo = Carbon::now()->subYear();

        // Delete logs older than 1 year
        $deletedCount = PriceUpdateLog::where('created_at', '<', $oneYearAgo)->delete();

        $this->info("$deletedCount price update logs deleted successfully.");
    }
}
