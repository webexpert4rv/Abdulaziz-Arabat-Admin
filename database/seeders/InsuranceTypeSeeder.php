<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsuranceType;
class InsuranceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //InsuranceType::truncate();
        InsuranceType::insert([
            [
                'name' => 'First Party',
            ],
            [
                'name' => 'Second Party',
            ],
            [
                'name' => 'Third Party',
            ],
           
        ]);
    }
}
