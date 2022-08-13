<?php

namespace Database\Seeders;

use App\User;
use Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('orders')->insert([
            0 => [
                'name' => 'Photo',
                'status' => 1,
                'rank' => 1,
                'details_required' => 1,
            ],
            1 => [
                'name' => 'Frame',
                'status' => 1,
                'rank' => 1,
                'details_required' => 1,
            ],
            2 => [
                'name' => 'Flex',
                'status' => 1,
                'rank' => 1,
                'details_required' => 1,
            ],
            3 => [
                'name' => 'Urgent',
                'status' => 1,
                'rank' => 1,
                'details_required' => 1,
            ],
            4 => [
                'name' => 'Reprint',
                'status' => 1,
                'rank' => 1,
                'details_required' => 1,
            ],
            5 => [
                'name' => 'Lamination(Photo)',
                'status' => 1,
                'rank' => 1,
                'details_required' => 1,
            ],


        ]);
    }
}
