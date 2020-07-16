<?php

namespace App\Console\Commands;

use App\Resource;
use App\TimeSlot;
use Illuminate\Console\Command;

class AddTimeSlot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axxess:add-timeslot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a time slot.';

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
        $headers = ['ID', 'Name', 'Time Slots'];
        //$resources = Resource::with('time_slots:id')->orderBy('id', 'asc')->get(['id', 'name']);
        $resources = Resource::with('time_slots')->get();
        $table_data = [];
        foreach ($resources as $resource) {
            $table_data[] = [
                'id' => $resource->id,
                'name' => $resource->name,
                'time_slots' => $resource->time_slots->implode('name', ', '),
            ];
        }
        $this->table($headers, $table_data);

        $resource_id = $this->ask('Which resource?');
        $time_slot_start = $this->ask('Begin of time slot (e.g. "10:00")');
        $time_slot_end = $this->ask('End of time slot (e.g. "10:00")');

        $resource = Resource::find($resource_id);

        $time_slot_start_name = explode(':', $time_slot_start);
        $time_slot_end_name = explode(':', $time_slot_end);

        $time_slot_start_name = count($time_slot_start_name) > 1 && (int)$time_slot_start_name[1] !== 0
            ? array_splice($time_slot_start_name, 0, 2)
            : array_splice($time_slot_start_name, 0, 1);

        $time_slot_end_name = count($time_slot_end_name) > 1 && (int)$time_slot_end_name[1] !== 0
            ? array_splice($time_slot_end_name, 0, 2)
            : array_splice($time_slot_end_name, 0, 1);

        $time_slot_name = implode(':', $time_slot_start_name) . '-' . implode(':', $time_slot_end_name);;

        $new_time_slot = new TimeSlot([
            'start' => $time_slot_start,
            'end' => $time_slot_end,
            'name' => $time_slot_name
        ]);

        $resource->time_slots()->save($new_time_slot);

        $this->info('Added new time slot to ' . $resource->name . ': ' . $new_time_slot);
    }
}
