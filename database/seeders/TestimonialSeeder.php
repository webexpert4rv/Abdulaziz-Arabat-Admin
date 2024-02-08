<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('testimonials')->truncate();
        \DB::table('testimonials')->insert([
            [
                'image'     => 'storage/TestimonialImage/testimonial.png',
                'name'     => 'KANE William',
                'description'=> '“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in in voluptate velit.“',
                'status'     =>'1' ,
            ],
            [
                'image'     => 'storage/TestimonialImage/testimonial.png',
                'name'     => 'John Doe',
                'description'=> '“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in in voluptate velit.“',
                'status'     =>'1' ,
            ],
            [
                'image'     => 'storage/TestimonialImage/testimonial.png',
                'name'     => 'Rihana KANE',
                'description'=> '“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in in voluptate velit.“',
                'status'     =>'1' ,
            ]
        ]);
        
    }
}
