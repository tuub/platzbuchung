<?php

namespace App\Console\Commands;

use App\CheckIn;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Console\Command;
use Mockery\Exception;

class GenerateUserReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axxess:user-report {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a user list for a given date.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $date = Carbon::parse($this->argument('date'));
            $check_ins = CheckIn::whereDate('check_in', $date)->get();
            $users = collect();
            $local_file_path = storage_path() . '/app/user_report.' . $date->format('Ymd') . '.txt';
            file_put_contents($local_file_path, '');
            $remote_host = env('REPORT_PROCESS_SERVER_HOST');
            $remote_user = env('REPORT_PROCESS_SERVER_USER');
            $remote_file_path = env('REPORT_PROCESS_SERVER_FILE_PATH');

            foreach ($check_ins as $check_in) {
                $users->push([
                    'barcode' => $check_in->user->barcode,
                    'phone' => $check_in->user->phone,
                    'date' => $date->format('d.m.Y'),
                    'time_from' => Carbon::parse($check_in->check_in)->format('H:i'),
                    'time_until' => $check_in ?
                        Carbon::parse($check_in->check_out)->format('H:i') :
                        Carbon::parse($check_in->booking()->withTrashed()->first()->end)->format('H:i'),
                    'resource' => $check_in->booking()->withTrashed()->first()->resource->name,
                ]);
            }

            if ($users->count() > 0) {
                $this->line('Generating user report with ' . $users->count() . ' records.');
                foreach ($users as $user) {
                    $content = implode(' # ', $user);
                    try {
                        file_put_contents($local_file_path, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
                    } catch (Exception $e) {
                        $this->warn('Error in file writing: ' . $e->getMessage());
                        $this->error('EXIT');
                    }
                }

                $this->info('Successfully generated user report.');

                try {
                    $this->line('Sending user report to processing server.');
                    exec('scp ' . $local_file_path . ' ' . $remote_user . '@' . $remote_host . ':' . $remote_file_path);
                } catch (Exception $e) {
                    $this->warn('Error in file sending: ' . $e->getMessage());
                    $this->error('EXIT');
                }

                $this->info('Successfully deployed user report to processing server.');

            } else {
                $this->warn('No checked-in users found for given date.');
            }
        } catch (InvalidFormatException $e) {
            $this->warn('Invalid date format: ' . $e->getMessage());
            $this->error('EXIT');
        }
    }
}
