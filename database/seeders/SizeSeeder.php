<?php

namespace Database\Seeders;

use App\Model\Size;
use App\User;
use Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //Photo size
        Size::firstOrCreate([
            'order_id' => 1,
            'name' => 'PP',
            'status' => 1,
            'rate' => '150',
        ]);

        Size::firstOrCreate([
            'order_id' => 1,
            'name' => 'MRP',
            'status' => 1,
            'rate' => '200',
        ]);


        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '2X2',
            'status' => 1,
            'rate' => '200',
        ]);



        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '4R',
            'status' => 1,
            'rate' => '15',
        ]);



        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '5R',
            'status' => 1,
            'rate' => '50',
        ]);


        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '6R',
            'status' => 1,
            'rate' => '80',
        ]);

        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '8X10',
            'status' => 1,
            'rate' => '150',
        ]);

        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '8X12',
            'status' => 1,
            'rate' => '200',
        ]);

        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '10X12',
            'status' => 1,
            'rate' => '350',
        ]);

        Size::firstOrCreate([
            'order_id' => 1,
            'name' => '10X15',
            'status' => 1,
            'rate' => '400',
        ]);

        //Frame Sizes
        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '4R',
            'status' => 1,
            'rate' => '400',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '5R',
            'status' => 1,
            'rate' => '500',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '6R',
            'status' => 1,
            'rate' => '600',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '8X10',
            'status' => 1,
            'rate' => '850',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '8X12',
            'status' => 1,
            'rate' => '1000',
        ]);


        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '10X12',
            'status' => 1,
            'rate' => '1350',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '10X15',
            'status' => 1,
            'rate' => '1600',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '12X15',
            'status' => 1,
            'rate' => '2000',
        ]);

        Size::firstOrCreate([
            'order_id' => 2,
            'name' => '12X18',
            'status' => 1,
            'rate' => '2500',
        ]);


        //For flex
        Size::firstOrCreate([
            'order_id' => 3,
            'name' => '12X18 in',
            'status' => 1,
            'rate' => '300',
        ]);

        Size::firstOrCreate([
            'order_id' => 3,
            'name' => '18X24 in',
            'status' => 1,
            'rate' => '400',
        ]);


        Size::firstOrCreate([
            'order_id' => 3,
            'name' => '24X36 in',
            'status' => 1,
            'rate' => '800',
        ]);


        //Frame laminations
        Size::firstOrCreate([
            'order_id' => 6,
            'name' => '5R',
            'status' => 1,
            'rate' => '500',
        ]);


        Size::firstOrCreate([
            'order_id' => 6,
            'name' => '6R',
            'status' => 1,
            'rate' => '600',
        ]);


        Size::firstOrCreate([
            'order_id' => 6,
            'name' => '8X10',
            'status' => 1,
            'rate' => '700',
        ]);


        Size::firstOrCreate([
            'order_id' => 6,
            'name' => '8X12',
            'status' => 1,
            'rate' => '800',
        ]);


        Size::firstOrCreate([
            'order_id' => 6,
            'name' => '10X12',
            'status' => 1,
            'rate' => '1000',
        ]);

        Size::firstOrCreate([
            'order_id' => 6,
            'name' => '10X15',
            'status' => 1,
            'rate' => '1200',
        ]);


        //Urgent
        Size::firstOrCreate([
            'order_id' => 4,
            'name' => 'PP',
            'status' => 1,
            'rate' => '250',
        ]);

        Size::firstOrCreate([
            'order_id' => 4,
            'name' => 'MRP',
            'status' => 1,
            'rate' => '250',
        ]);

        Size::firstOrCreate([
            'order_id' => 4,
            'name' => '2X2',
            'status' => 1,
            'rate' => '250',
        ]);

        Size::firstOrCreate([
            'order_id' => 4,
            'name' => '4R(Snap)',
            'status' => 1,
            'rate' => '250',
        ]);


        Size::firstOrCreate([
            'order_id' => 4,
            'name' => '4R',
            'status' => 1,
            'rate' => '100',
        ]);

        Size::firstOrCreate([
            'order_id' => 4,
            'name' => '8R with Frame',
            'status' => 1,
            'rate' => '1200',
        ]);

        Size::firstOrCreate([
            'order_id' => 4,
            'name' => '8X12 with Frame',
            'status' => 1,
            'rate' => '1500',
        ]);

        Size::firstOrCreate([
            'order_id' => 4,
            'name' => '10X15 with Frame',
            'status' => 1,
            'rate' => '2000',
        ]);


        //Reprint

        Size::firstOrCreate([
            'order_id' => 5,
            'name' => 'PP',
            'status' => 1,
            'rate' => '120',
        ]);

        Size::firstOrCreate([
            'order_id' => 5,
            'name' => 'MRP',
            'status' => 1,
            'rate' => '120',
        ]);

        Size::firstOrCreate([
            'order_id' => 7,
            'name' => '3.5 X 8',
            'status' => 1,
            'rate' => '400',
        ]);

        Size::firstOrCreate([
            'order_id' => 8,
            'name' => '3.5 X 8',
            'status' => 1,
            'rate' => '800',
        ]);
    }
}
