<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	*/
	public function run() {
		$this->call([
			// PagesSeeder::class,
			  //RolesSeeder::class,
			 // AdminsSeeder::class,
			 // ServiceStatusSeeder::class,
			 // GoodsSeeder::class,
			 // ServiceCategorySeeder::class,
			// UsersSeeder::class,
		     //PermissionsSeeder::class,
			//RegionSeeder::class,
			//SubRegionSeeder::class,
			VehicleTypeSeeder::class,
			VehicleTypeCategorySeeder::class,
			ProductSeeder::class,
			
		]);
	}
}

