<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RenameLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:rename';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rename laravel.log file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentLogFile = storage_path('logs/laravel.log');
        $newLogFile = storage_path('logs/laravel_' . date('Y-m-d_H-i-s') . '.log');

        if (file_exists($currentLogFile)) {
            rename($currentLogFile, $newLogFile);
            $this->info('laravel.log file renamed successfully.');

            // Create a new log file
            file_put_contents($currentLogFile, '');
            // Set the permissions of the new log file to 0777
            chmod($currentLogFile, 0777);
            $this->info('New laravel.log file created with 0777 permissions.');

        } else {
            $this->error('laravel.log file not found.');
        }
    }
}
