<?php

namespace App\Console\Commands;

use App\Resource;
use Illuminate\Console\Command;

class ChangeResourceCapacity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axxess:change-capacity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the capacity of resources.';

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
        $headers = ['ID', 'Name', 'Capacity'];
        $resources = Resource::orderBy('id', 'asc')->get(['id', 'name', 'capacity'])->toArray();
        $this->table($headers, $resources);
        $resource_id = $this->ask('Which resource?');

        $resource = Resource::find($resource_id);

        if ($resource) {
            $old_capacity = $resource->capacity;
            $new_capacity = $this->ask('New capacity?');

            $resource->update([
                'capacity' => $new_capacity
            ]);
            $this->info('Changed capacity of ' . $resource->name . ' from ' . $old_capacity . ' to ' . $new_capacity . '.');
        } else {
            $this->warn('Resource ID "' . $resource_id . '" is not valid.');
            $this->error('EXIT');
        }
    }
}
