<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveOldLogFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:remove-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove laravel log files older than 7 days';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $logDirectory = storage_path('logs');
        $files = File::files($logDirectory);

        foreach ($files as $file) {
            $fileModificationTime = File::lastModified($file);
            $fileAgeInSeconds = now()->getTimestamp() - $fileModificationTime;
            $fileAgeInDays = round($fileAgeInSeconds / (60 * 60 * 24),2);

            if ($fileAgeInDays > 30) {
                File::delete($file);
                $this->info("Deleted log file: $file, Last Modified: " . date('Y-m-d H:i:s', $fileModificationTime));
            }
        }
    }
}
