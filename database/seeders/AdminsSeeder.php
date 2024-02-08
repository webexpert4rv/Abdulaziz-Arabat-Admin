<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

class AdminsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		
		// Admins
		
		\DB::table('admins')->delete();
		\DB::table('admins')->insert([
			[
				'role_id' => 1,
				'full_name' => 'Admin',
				'email' => 'superadmin@arabat.com',
				'password' => Hash::make('Sup3r@dm!n'),

			]
		]);
	}
}
