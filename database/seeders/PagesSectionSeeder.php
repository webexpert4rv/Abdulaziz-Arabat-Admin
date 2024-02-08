<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pages_sections')->truncate();
        \DB::table('pages_sections')->insert([
            [
                'title'         => 'Privacy Policy',
                'slug'          => 'privacy_policy',
                'device_type'   => 'web',
                'status'        => 'active',
            ],
            [
                'title'         => 'Terms & Conditions',
                'slug'          => 'privacy_policy',
                'device_type'   => 'web',
                'status'        => 'active',
            ],
            [
                'title'         => 'About Us',
                'slug'          => 'about_us',
                'device_type'   => 'web',
                'status'        => 'active',
            ],
            [
                'title'         => 'Our Services',
                'slug'          => 'our_services',
                'device_type'   => 'web',
                'status'        => 'active',
            ],
            [
                'title'         => 'Help',
                'slug'          => 'help',
                'device_type'   => 'web',
                'status'        => 'active',
            ],
            [
                'title'         => 'Privacy Policy',
                'slug'          => 'privacy_policy',
                'device_type'   => 'mobile',
                'status'        => 'active',
            ],
            [
                'title'         => 'Terms & Conditions  ',
                'slug'          => 'terms_and_conditions',
                'device_type'   => 'mobile',
                'status'        => 'active',
            ],
            
           
        ]);
    }
}
