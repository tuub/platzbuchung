<?php

namespace App\Console\Commands;

use App\Location;
use App\Resource;
use App\TimeSlot;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BatchTimeSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platzbuchung:add-timeslots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batch-add new timeslots per location and per resource.';

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
        $locations = Location::with('resources')->get();
        foreach ($locations as $location) {
            $this->info($location->id . ': ' . $location->name);
        }

        $location_id = $this->ask('Which location?');
        $location = $locations->find($location_id);

        if ($location) {

            $week_days = $this->ask('Which days (comma-separated)?');
            $config = [];
            $config['start'] = $this->ask('Which start (HH:MM)?');
            $config['end'] = $this->ask('Which end (HH:MM)?');
            $config['date_from'] = $this->ask('Valid from date (DD.MM.YYYY)?');
            $config['date_to'] = $this->ask('Valid to date (DD.MM.YYYY)?');

            foreach ($location->resources as $resource) {
                $this->info($resource->id . ': ' . $resource->name);
            }

            $resource_ids = $this->ask('Which resources (comma-separated)?');

            foreach (explode(',', $resource_ids) as $resource_id) {
                $resource = $location->resources()->find($resource_id);

                if ($resource) {
                    foreach (explode(',', $week_days) as $week_day) {
                        TimeSlot::create(
                            [
                                'resource_id' => $resource->id,
                                'week_day' => $week_day,
                                'start' => Carbon::parse($config['start']),
                                'end' => Carbon::parse($config['end']),
                                'date_from' => $config['date_from'] ? Carbon::parse($config['date_from']) : null,
                                'date_to' => $config['date_to'] ? Carbon::parse($config['date_to']) : null,
                            ]
                        );
                        $this->info("Added time slot: " . json_encode($config) . ' for resource ' . $resource->name .
                            ' on weekday ' . $week_day);
                    }
                } else {
                    $this->error('Resource not found.');
                }
            }

        } else {
            $this->error('Location not found.');
        }
    }
}
