<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		 \DB::table('roles')->delete();
		\DB::table('roles')->insert([
			[
				'name' => 'Super Admin',
				'tag' => 'super_admin',
				'status' => 1,
				'role_type'=>'admins',
			],
			[
				'name' => 'Transporter',
				'tag' => 'Transporter',
				'status' => 1,
				'role_type'=>'users',
			],
			[
				'name' => 'User',
				'tag' => 'user',
				'status' => 1,
				'role_type'=>'users',
			],
			[
				'name' => 'Driver',
				'tag' => 'driver',
				'status' => 1,
				'role_type'=>'users',
			],
		]);
	}
}
 