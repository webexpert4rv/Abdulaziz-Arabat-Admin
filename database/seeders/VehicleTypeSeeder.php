<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;
class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          
         // \DB::table('vehicle_types')->delete();
        //VehicleType::truncate();
        VehicleType::insert([
            [
                
                'name'      =>'Lorry with refrigerator',
                'max_load'  =>'8',  
                'arabic_name'=>'',
                'image'  =>'storage/vehicle_type_category/lorry-refrigerator.png',  
                'length'    =>'6.5',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Lorry with freezer',
                'max_load'  =>'8', 
                'arabic_name'=>'',
                'image'  =>'storage/vehicle_type_category/lorry-freezer.png', 
                'length'    =>'6.5',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Lorry with crane',
                'max_load'  =>'5', 
                'arabic_name'=>'',
                'image'  =>'storage/vehicle_type_category/lorry-crane.png', 
                'length'    =>'6.5',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Lorry with Sides',
                'image'  =>'storage/vehicle_type_category/lorry-sides.png', 
                'arabic_name'=>'',
                'max_load'  =>'8',  
                'length'    =>'6.5',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Lorry Closed',
                'image'  =>'storage/vehicle_type_category/lorry-closed.png', 
                'arabic_name'=>'',
                'max_load'  =>'8',  
                'length'    =>'6.5',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Lorry with crane',
                'image'  =>'storage/vehicle_type_category/lorry-crane.png',
                'arabic_name'=>'',
                'max_load'  =>'7',  
                'length'    =>'6.5',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Dyna with refrigerator',
                'image'     =>'storage/vehicle_type_category/dyna-refrigerator.png',
                'arabic_name'=>'',
                'max_load'  =>'4',  
                'length'    =>'',
                'status'    =>'1',                
                'max_load_unit'=>'Tons',
                'unit'    =>'', 
            ],[
                
                'name'      =>'Dyna with freezer',
                'arabic_name'=>'',
                'max_load'  =>'4',  
                'length'    =>'',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/dyna-freezer.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'', 
            ],[
                
                'name'      =>'Dyna with crane',
                'arabic_name'=>'',
                'max_load'  =>'4.5',  
                'length'    =>'',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/dyna-crane.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'', 
            ],[
                
                'name'      =>'Dyna with Sides',
                'arabic_name'=>'',
                'max_load'  =>'4.5',  
                'length'    =>'',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/dyna-sides.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'', 
            ],[
                
                'name'      =>'Lorry Closed',
                'arabic_name'=>'',
                'max_load'  =>'7',  
                'length'    =>'4.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/dyna-closed.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Six-wheeler truck with sides',
                'arabic_name'=>'',
                'max_load'  =>'13',  
                'length'    =>'7',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/truck-sides.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Six-wheeler truck with refrigerator',
                'arabic_name'=>'',
                'max_load'  =>'13',  
                'length'    =>'7',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/truck-refrigerator.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Traila Truck Freezer',
                'arabic_name'=>'',
                'max_load'  =>'20',  
                'length'    =>'13.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/traila-freezer.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Traila Truck refrigerator',
                'arabic_name'=>'',
                'max_load'  =>'20',  
                'length'    =>'13.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/traila-refrigerator.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Traila Truck German',
                'arabic_name'=>'',
                'max_load'  =>'25',  
                'length'    =>'13.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/traila-german.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Traila Truck flatbed',
                'arabic_name'=>'',
                'max_load'  =>'25',  
                'length'    =>'13.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/traila-flatbed.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Traila Truck with Sides',
                'arabic_name'=>'',
                'max_load'  =>'25',  
                'length'    =>'13.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/traila-dides.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],[
                
                'name'      =>'Traila Truck curtains',
                'arabic_name'=>'',
                'max_load'  =>'25',  
                'length'    =>'13.5',
                'status'    =>'1',                
               'image'  =>'storage/vehicle_type_category/traila-crane.png',
                'max_load_unit'=>'Tons',
                'unit'    =>'meter', 
            ],             

        ]);
    }
}
