<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('banners')->truncate();
        \DB::table('banners')->insert([
            [
                'image'     => 'storage/BannerImage/banner.png',
                'title'     => 'WE MAKE STRONGEST SERVICE ABOVE THE WORLD',
                'description'=> 'Some representative placeholder content for the first slide.',
                'status'     =>'1' ,
            ],
            [
                'image'     => 'storage/BannerImage/banner.png',
                'title'     => 'WE MAKE STRONGEST SERVICE ABOVE THE WORLD',
                'description'=> 'Some representative placeholder content for the second slide.',
                'status'     =>'1' ,
            ],
            [
                'image'     => 'storage/BannerImage/banner.png',
                'title'     => 'WE MAKE STRONGEST SERVICE ABOVE THE WORLD',
                'description'=> 'Some representative placeholder content for the third slide.',
                'status'     =>'1' ,
            ]
        ]);
    }
}
