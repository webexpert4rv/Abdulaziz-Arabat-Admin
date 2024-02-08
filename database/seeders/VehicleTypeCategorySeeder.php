<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleTypeCategory;
class VehicleTypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         //\DB::table('vehicle_type_categories')->delete();
          VehicleTypeCategory::truncate();
          VehicleTypeCategory::insert([
            [
                'name' => 'Lorry',                        
                'status' => '1', 
            ],
            [
                'name' => 'Dyna',                        
                'status' => '1', 
            ],
            [
                'name' => 'Six-wheeler truck',                        
                'status' => '1', 
            ],
            [
                'name' => 'Traila Truck',                        
                'status' => '1', 
            ] 
             
             
        ]);
    }
}
 