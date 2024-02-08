<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Hash;

class UsersSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		
		// Users
		
		 //\DB::table('users')->delete();
		\DB::table('users')->insert([
			[
				'name' => 'John Doe',
				'first_name' => 'John',
				'last_name' => 'Doe',
				'email' => 'transport@gmail.com',
				'password' => Hash::make('12345678'),
				'role_id' => 2,
				'created_at' => Carbon::now(),
			],
			[
				'name' => 'Sam Martin',
				'first_name' => 'Sam',
				'last_name' => 'Martin',
				'email' => 'user@gmail.com',
				'password' => Hash::make('12345678'),
				'role_id' => 3,
				'created_at' => Carbon::now(),
			]
		]);
	}
}
