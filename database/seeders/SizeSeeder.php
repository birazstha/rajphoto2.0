<?php

namespace Database\Seeders;

use App\User;
use Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sizes')->insert([
            //Photo sizes
            0 => [
                'order_id' => 1,
                'name' => 'PP',
                'status' => 1,
            ],
            1 => [
                'order_id' => 1,
                'name' => 'MRP',
                'status' => 1,
            ],
            2 => [
                'order_id' => 1,
                'name' => 'PP',
                'status' => 1,
            ],
            3 => [
                'order_id' => 1,
                'name' => '2X2',
                'status' => 1,
            ],
            4 => [
                'order_id' => 1,
                'name' => '4R',
                'status' => 1,
            ],
            5 => [
                'order_id' => 1,
                'name' => '5R',
                'status' => 1,
            ],
            6 => [
                'order_id' => 1,
                'name' => '6R',
                'status' => 1,
            ],
            7 => [
                'order_id' => 1,
                'name' => '8R',
                'status' => 1,
            ],
            8 => [
                'order_id' => 1,
                'name' => '10R',
                'status' => 1,
            ],

            //Frame sizes
            9 => [
                'order_id' => 2,
                'name' => '5R',
                'status' => 1,
            ],
            10 => [
                'order_id' => 2,
                'name' => '6R',
                'status' => 1,
            ],
            11 => [
                'order_id' => 2,
                'name' => '8X10',
                'status' => 1,
            ],
            12 => [
                'order_id' => 2,
                'name' => '8X12',
                'status' => 1,
            ],
            13 => [
                'order_id' => 2,
                'name' => '10X12',
                'status' => 1,
            ],

            //For flex
            14 => [
                'order_id' => 3,
                'name' => 'Size 1',
                'status' => 1,
            ],
            15 => [
                'order_id' => 3,
                'name' => 'Size 2',
                'status' => 1,
            ],
            16 => [
                'order_id' => 3,
                'name' => 'Size 3',
                'status' => 1,
            ],

            //Frame laminations
            17 => [
                'order_id' => 6,
                'name' => '5R',
                'status' => 1,
            ],
            18 => [
                'order_id' => 6,
                'name' => '6R',
                'status' => 1,
            ],
            19 => [
                'order_id' => 6,
                'name' => '8X10',
                'status' => 1,
            ],
            20 => [
                'order_id' => 6,
                'name' => '8X12',
                'status' => 1,
            ],
            21 => [
                'order_id' => 6,
                'name' => '10X12',
                'status' => 1,
            ],

            //Urgent
            22 => [
                'order_id' => 4,
                'name' => 'PP',
                'status' => 1,
            ],
            23 => [
                'order_id' => 4,
                'name' => 'MRP',
                'status' => 1,
            ],
            24 => [
                'order_id' => 4,
                'name' => 'PP',
                'status' => 1,
            ],
            25 => [
                'order_id' => 4,
                'name' => '2X2',
                'status' => 1,
            ],
            26 => [
                'order_id' => 4,
                'name' => '4R',
                'status' => 1,
            ],
            27 => [
                'order_id' => 4,
                'name' => '5R',
                'status' => 1,
            ],
            28 => [
                'order_id' => 4,
                'name' => '6R',
                'status' => 1,
            ],
            29 => [
                'order_id' => 4,
                'name' => '8R',
                'status' => 1,
            ],
            30 => [
                'order_id' => 4,
                'name' => '10R',
                'status' => 1,
            ],

            //Reprint
            31 => [
                'order_id' => 5,
                'name' => 'PP',
                'status' => 1,
            ],
            32 => [
                'order_id' => 5,
                'name' => 'MRP',
                'status' => 1,
            ],
            33 => [
                'order_id' => 5,
                'name' => '4R',
                'status' => 1,
            ],

        ]);
    }
}
