<?php

namespace Database\Seeders;

use App\Model\FrontendUser;
use App\Model\Saving;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Saving::firstOrCreate([
            'bank_name' => 'Aadharshila Sahakari Sanstha',
            'status' => 1,
        ]);

        Saving::firstOrCreate([
            'bank_name' => 'Tarapunja Sahakari Sanstha',
            'status' => 1,
        ]);

        Saving::firstOrCreate([
            'bank_name' => 'Navajeevan Sahakari Sanstha',
            'status' => 1,
        ]);

    }
}
