<?php

namespace Database\Seeders;

use App\Model\FrontendUser;
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
        
        \DB::table('savings')->insert([
            0 => [
                'bank_name' => 'Aadharshila Sahakari Sanstha',
                'status' => 1,
            ],
            1 => [
                'bank_name' => 'Tarapunja Sahakari Sanstha',
                'status' => 1,
            ],
            2 => [
                'bank_name' => 'Navajeevan Sahakari Sanstha',
                'status' => 1,
            ],

        ]);
    }
}
