<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobLog;
use Carbon\Carbon;

class DeleteOldJobLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'joblogs:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Job logs older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Calculate the date 7 days ago
        $sevenDaysAgo = Carbon::now()->subDays(7);        

        // Delete logs older than 7 days
        $deletedCount = JobLog::where('created_at', '<', $sevenDaysAgo)->delete();

        // $this->info("$deletedCount logs deleted successfully.");
        \Log::info("$deletedCount logs deleted successfully.");
    }
}
