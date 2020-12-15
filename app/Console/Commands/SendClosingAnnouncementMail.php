<?php

namespace App\Console\Commands;

use App\Booking;
use App\User;
use App\Mail\ClosingAnnouncement;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendClosingAnnouncementMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platzbuchung:send-closing-announcement {--dry-run} {start_date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send closing notification to mail addresses of users who have bookings from a given date on.';

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
     * @return int
     */
    public function handle()
    {
        $recipients = [];
        $start_date = Carbon::parse($this->argument('start_date'));
        $is_dry_run = (bool)$this->option('dry-run');

        $bookings = Booking::where('date', '>=', $start_date)->get();

        foreach ($bookings as $booking) {
            if(!in_array($booking->user->email, $recipients))
            {
                $recipients[] = $booking->user->email;
            }
        }

        if ($is_dry_run) {
            $this->warn('This is a dry-run only. Email would go to ' . count($recipients) . ' recipients.' . PHP_EOL);
        }

        $progress = $this->output->createProgressBar(count($recipients));
        $progress->start();        
        foreach ($recipients as $recipient) {
            if (!$is_dry_run) {
                Mail::to($recipient)->send(new ClosingAnnouncement());
            }
            $progress->advance();
        }
        $progress->finish();

        $this->info(PHP_EOL . PHP_EOL . 'All done. Sent ' . count($recipients) . ' emails.');
    }
}
