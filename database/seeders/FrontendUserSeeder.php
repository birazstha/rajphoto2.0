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

        FrontendUser::firstOrCreate(
            [
                'name' => 'Raj Shrestha',
                'status' => 1,
            ]
        );

        FrontendUser::firstOrCreate(
            [
                'name' => 'Biraj Shrestha',
                'status' => 1,
            ]
        );

        FrontendUser::firstOrCreate(
            [
                'name' => 'Rajeev Shrestha',
                'status' => 1,
            ]
        );


    }
}
