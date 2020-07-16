<?php

namespace App\Console\Commands;

use App\Resource;
use Illuminate\Console\Command;

class AddResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'axxess:add-resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new resource.';

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
        $resource_name = $this->ask('Resource name (e.g. "UB TU Etage 1")');
        $resource_short_name = $this->ask('Resource short name (e.g. "Etage 1")');
        $resource_capacity = $this->ask('Resource capacity (e.g. "30")');
        $resource_color = $this->ask('Resource color (e.g. "#336699"), optional');
        $resource_text_color = $this->ask('Resource text-color that reads well on the given resource color (e.g. "#ff6600"), optional');
        $resource_address = $this->ask('Resource address (e.g. "Universitätsbibliothek der TU, Fasanenstr. 88, 10623 Berlin")');

        $resource_data = [
            'name' => $resource_name,
            'short_name' => $resource_short_name,
            'capacity' => $resource_capacity,
            'address' => $resource_address,
        ];

        if (strlen($resource_color) > 0) {
            $resource_data['color'] = $resource_color;
        }

        if (strlen($resource_text_color) > 0) {
            $resource_data['text_color'] = $resource_text_color;
        }

        $resource = Resource::create($resource_data);

        $this->info('Added new resource: ' . implode(', ', $resource_data));
    }
}
