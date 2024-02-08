<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Goods;
class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goods::truncate();
        Goods::insert([
            [
                'name' => 'ALLCARGO',                        
                'status' => 1, 
            ],
             
        ]);
    }
}
