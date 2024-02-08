<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // ServiceCategory::delete();
        ServiceCategory::insert([
            [
                'name' => 'Moving goods ',                        
                'status' => '1', 
            ],
            [
                'name' => 'Moving through refrigerated trucks',                        
                'status' => '1', 
            ],
             [
                'name' => 'Moving furniture ',                        
                'status' => '1', 
            ],
             
        ]);
    }
}
