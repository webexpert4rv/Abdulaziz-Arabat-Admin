<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PreferredLocation;
class PreferredLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PreferredLocation::truncate();
        PreferredLocation::insert([
            [
                'name' => 'Mohali',
                'status' => '1',
            ],
            [
                'name' => 'Chandigarh',
                'status' => '1',
            ],
            [
                'name' => 'Delhi',
                'status' => '1',
            ],
           
        ]);
    }
}
