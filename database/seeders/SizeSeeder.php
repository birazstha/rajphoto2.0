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
                'rate'=>'150',
            ],
            1 => [
                'order_id' => 1,
                'name' => 'MRP',
                'status' => 1,
                'rate'=>'200',
            ],
          
            2 => [
                'order_id' => 1,
                'name' => '2X2',
                'status' => 1,
                'rate'=>'200',
            ],
            3 => [
                'order_id' => 1,
                'name' => '4R',
                'status' => 1,
                'rate'=>'15',
            ],
            4 => [
                'order_id' => 1,
                'name' => '5R',
                'status' => 1,
                'rate'=>'50',
            ],
            5 => [
                'order_id' => 1,
                'name' => '6R',
                'status' => 1,
                'rate'=>'80',
            ],
            6 => [
                'order_id' => 1,
                'name' => '8X10',
                'status' => 1,
                'rate'=>'150',
            ],
            7 => [
                'order_id' => 1,
                'name' => '8X12',
                'status' => 1,
                'rate'=>'200',
            ],
            8 => [
                'order_id' => 1,
                'name' => '10X12',
                'status' => 1,
                'rate'=>'350',
            ],
            9 => [
                'order_id' => 1,
                'name' => '10X15',
                'status' => 1,
                'rate'=>'400',
            ],

            //Frame sizes
            10 => [
                'order_id' => 2,
                'name' => '4R',
                'status' => 1,
                'rate'=>'400',
            ],
            11 => [
                'order_id' => 2,
                'name' => '5R',
                'status' => 1,
                'rate'=>'500',
            ],
            12 => [
                'order_id' => 2,
                'name' => '6R',
                'status' => 1,
                'rate'=>'600',
            ],
            13 => [
                'order_id' => 2,
                'name' => '8X10',
                'status' => 1,
                'rate'=>'850',
            ],
            14 => [
                'order_id' => 2,
                'name' => '8X12',
                'status' => 1,
                'rate'=>'100',
            ],
            15 => [
                'order_id' => 2,
                'name' => '10X12',
                'status' => 1,
                'rate'=>'1350',
            ],
            16 => [
                'order_id' => 2,
                'name' => '10X15',
                'status' => 1,
                'rate'=>'1600',
            ],
            17 => [
                'order_id' => 2,
                'name' => '12X15',
                'status' => 1,
                'rate'=>'2000',
            ],
            18 => [
                'order_id' => 2,
                'name' => '12X18',
                'status' => 1,
                'rate'=>'2500',
            ],

            //For flex
            19 => [
                'order_id' => 3,
                'name' => '12X18 in',
                'status' => 1,
                'rate'=>'300',
            ],
            20 => [
                'order_id' => 3,
                'name' => '18X24 in',
                'status' => 1,
                'rate'=>'400',
            ],
            21 => [
                'order_id' => 3,
                'name' => '24X36 in',
                'status' => 1,
                'rate'=>'800',
            ],

            //Frame laminations
            22 => [
                'order_id' => 6,
                'name' => '5R',
                'status' => 1,
                'rate'=>'500',
            ],
            23 => [
                'order_id' => 6,
                'name' => '6R',
                'status' => 1,
                'rate'=>'600',
            ],
            24 => [
                'order_id' => 6,
                'name' => '8X10',
                'status' => 1,
                'rate'=>'700',
            ],
            25 => [
                'order_id' => 6,
                'name' => '8X12',
                'status' => 1,
                'rate'=>'800',
            ],
            26 => [
                'order_id' => 6,
                'name' => '10X12',
                'status' => 1,
                'rate'=>'1000',
            ],
            27 => [
                'order_id' => 6,
                'name' => '10X15',
                'status' => 1,
                'rate'=>'1200',
            ],

            //Urgent
            28 => [
                'order_id' => 4,
                'name' => 'PP',
                'status' => 1,
                'rate'=>'250',
            ],
            29 => [
                'order_id' => 4,
                'name' => 'MRP',
                'status' => 1,
                'rate'=>'250',
            ],
            30 => [
                'order_id' => 4,
                'name' => '2X2',
                'status' => 1,
                'rate'=>'250',
            ],
            31 => [
                'order_id' => 4,
                'name' => '4R(Snap)',
                'status' => 1,
                'rate'=>'250',
            ],
            32 => [
                'order_id' => 4,
                'name' => '4R',
                'status' => 1,
                'rate'=>'100',
            ],
          
            33 => [
                'order_id' => 4,
                'name' => '8R with Frame',
                'status' => 1,
                'rate'=>'1200',
            ],
            34 => [
                'order_id' => 4,
                'name' => '8X12 with Frame',
                'status' => 1,
                'rate'=>'1500',
            ],
            35 => [
                'order_id' => 4,
                'name' => '10X15 with Frame',
                'status' => 1,
                'rate'=>'2000',
            ],

            //Reprint
            36 => [
                'order_id' => 5,
                'name' => 'PP',
                'status' => 1,
                'rate'=>'120',
            ],
            37 => [
                'order_id' => 5,
                'name' => 'MRP',
                'status' => 1,
                'rate'=>'120',
            ],
        ]);
    }
}
