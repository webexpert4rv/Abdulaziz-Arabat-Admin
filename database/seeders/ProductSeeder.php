<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //  Product::truncate();        
        Product::insert([

            [
                'name' => 'Box',                        
                'arabic_name' => 'علبة',                        
                'status' => 1, 
            ],
            [
                'name' => 'Roll', 
                'arabic_name' => 'لفافة',                        
                'status' => 1, 
            ],
            [
                'name' => 'Pallet',
                'arabic_name' => 'البليت',                         
                'status' => 1, 
            ],
            [
                'name' => 'Bag',   
                'arabic_name' => 'حقيبة',                      
                'status' => 1, 
            ],
            [
                'name' => 'Equipment',  
                'arabic_name' => 'معدات',                       
                'status' => 1, 
            ],
            [
                'name' => 'Heavy Equipment', 
                'arabic_name' => 'معدات ثقيلة',                        
                'status' => 1, 
            ],
            [
                'name' => 'Prefabricated Room', 
                'arabic_name' => 'غرفة مسبقة الصنع',                        
                'status' => 1, 
            ],
            [
                'name' => 'Prefabricated Concrete',   
                'arabic_name' => 'الخرسانة الجاهزة',                      
                'status' => 1, 
            ],
            [
                'name' => 'Steel Beams', 
                'arabic_name' => 'الدعامات الفولاذية',                        
                'status' => 1, 
            ],
            [
                'name' => 'Wood Bundle',  
                'arabic_name' => 'حزمة الخشب',                       
                'status' => 1, 
            ],
            [
                'name' => 'Cylinder',  
                'arabic_name' => 'اسطوانة',                    
                'status' => 1, 
            ],
            [
                'name' => 'Other', 
                'arabic_name' => 'آخر',                     
                'status' => 1, 
            ],

        ]);
    }
}
 
