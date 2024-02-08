<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceStatus;

class ServiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        ServiceStatus::truncate();
        ServiceStatus::insert([[
                        'name' => 'Started',
                        'slug' => 'started',
                        'status' => 1, 
                    ],
                    [
                        'name' => 'Transporter at pick up location',
                        'slug' => 'transporter_at_pick_up_location',
                        'status' => 1, 
                    ],
                    [
                        'name' => 'Goods picked up',
                        'slug' => 'goods_picked_up',
                        'status' => 1, 
                    ],
                    [
                        'name' => 'On the way',
                        'slug' => 'on_the_way',
                        'status' => 1, 
                    ],
                    [
                        'name' => 'Arrived at destination',
                        'slug' => 'arrived_at_destination',
                        'status' => 1, 
                    ],
                    [
                        'name' => 'Delivered',
                        'slug' => 'delivered',
                        'status' => 1, 
                    ],
                    [
                        'name' => 'Service Completed',
                        'slug' => 'service_completed',
                        'status' => 1, 
                    ]],);
        
    }
}
