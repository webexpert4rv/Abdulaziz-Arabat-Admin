<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Region::truncate();        
        Region::insert([
            [
                'name' => 'Mekka Mukaramah', 
                'arabic_name'=>'',                       
                'status' => 1, 
            ],
            [
                'name' => 'Riyadh',
                'arabic_name'=>'',                        
                'status' => 1, 
            ],
            [
                'name' => 'Eastern Province',
                'arabic_name'=>'',                        
                'status' => 1, 
            ],
            [
                'name' => 'Medinah Monourah',
                'arabic_name'=>'',                        
                'status' => 1, 
            ],
            [
                'name' => 'Qassim', 
                'arabic_name'=>'',                       
                'status' => 1, 
            ],
            [
                'name' => 'Hayil',
                'arabic_name'=>'',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Aseer',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Najran',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Jaizan',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Tabouk',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Jouf',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Northern Province',                        
                'arabic_name'=>'',
                'status' => 1, 
            ],
            [
                'name' => 'Al Baha',                        
                'arabic_name'=>'',
                'status' => 1, 
            ]
             
        ]);
    }
}
 