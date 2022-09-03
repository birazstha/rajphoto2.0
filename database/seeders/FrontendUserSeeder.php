<?php

namespace Database\Seeders;

use App\Model\FrontendUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FrontendUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('frontend_users')->insert([
            0 => [
                'name' => 'Raj Shrestha',
                'status' => 1,
            ],
            1 => [
                'name' => 'Biraj Shrestha',
                'status' => 1,
            ],
            2 => [
                'name' => 'Rajeev Shrestha',
                'status' => 1,
            ],

        ]);
    }
}
