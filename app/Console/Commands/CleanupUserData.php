<?php

namespace App\Console\Commands;

use App\Booking;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanupUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platzbuchung:cleanup-userdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean it up!';

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
     * See also: https://laravel-news.com/deleting-old-soft-deleted-records-with-quicksand
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $today = Carbon::today();
        $wall_date = $today->subDays(30);
        $table_headers = ['Task', 'Total', 'Affected', 'Percentage'];

        $total_bookings = Booking::withTrashed()->count();
        $total_users = User::count();

        // Compile old bookings
        $bookings_to_delete = Booking::withTrashed()->whereDate('deleted_at', '<', $wall_date)
            ->orWhere([
                ['deleted_at', null],
                ['updated_at', '<', $wall_date],
                ['date', '<', $wall_date],
            ])
            ->orderBy('date', 'asc')
            ->get();

        $table_tasks[] = [
            'task' => 'Bookings deleted before ' . $wall_date->format('Y-m-d'),
            'total' => $total_bookings,
            'affected' => $bookings_to_delete->count(),
            'percentage' => floor(($bookings_to_delete->count() / $total_bookings) * 100) . ' %',
        ];

        // Compile old logins
        $users_to_delete = User::whereDate('last_login', '<', $wall_date)->get();

        $table_tasks[] = [
            'task' => 'Users with last login before ' . $wall_date->format('Y-m-d'),
            'total' => $total_users,
            'affected' => $users_to_delete->count(),
            'percentage' => floor(($users_to_delete->count() / $total_users) * 100) . ' %',
        ];

        // Get summary table
        $this->table($table_headers, $table_tasks);

        // Delete the old bookings
        $progress = $this->output->createProgressBar($bookings_to_delete->count());
        $progress->start();
        foreach ($bookings_to_delete as $booking) {
            $booking->delete();
            $progress->advance();
        }
        $progress->finish();

        // Delete the old users
        $progress = $this->output->createProgressBar($users_to_delete->count());
        $progress->start();
        foreach ($users_to_delete as $user) {
            $user->delete();
            $progress->advance();
        }
        $progress->finish();
    }
}
