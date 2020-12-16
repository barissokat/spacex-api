<?php

namespace App\Console\Commands;

use App\Capsule;
use App\Mission;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GetAllDataX extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spacex:get-all-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all data from spaceX api every 3 minutes';

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
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.spacexdata.com/v3/']);

        $response = $client->request('GET', 'capsules');

        $data_capsules = json_decode((string) $response->getBody()->getContents(), true);

        foreach ($data_capsules as $item) {
            if (Capsule::where('capsule_serial', $item['capsule_serial'])->first() == null) {
                $capsule = Capsule::create([
                    'capsule_serial' => $item['capsule_serial'],
                    'capsule_id' => $item['capsule_id'],
                    'status' => $item['status'],
                    'original_launch' => $item['original_launch'],
                    'original_launch_unix' => $item['original_launch_unix'],
                    'landings' => $item['landings'],
                    'type' => $item['type'],
                    'details' => $item['details'],
                    'reuse_count' => $item['reuse_count'],
                ]);

                foreach ($item['missions'] as $item_mission) {

                    if (Mission::where([['capsule_id', $capsule->id], ['name', $item_mission['name']]])->first() == null) {
                        Mission::create([
                            'capsule_id' => $capsule->id,
                            'name' => $item_mission['name'],
                            'flight' => $item_mission['flight'],
                        ]);
                    }
                }
            }
        }
    }
}
