<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'rate' => null,

            ],
            1 => [
                'name' => 'Frame',
                'status' => 1,
                'rank' => 2,
                'details_required' => 1,
                'rate' => null,

            ],
            2 => [
                'name' => 'Flex',
                'status' => 1,
                'rank' => 3,
                'details_required' => 1,
                'rate' => null,
            ],

            3 => [
                'name' => 'Urgent',
                'status' => 1,
                'rank' => 4,
                'details_required' => 1,
                'rate' => null,
            ],

            4 => [
                'name' => 'Reprint',
                'status' => 1,
                'rank' => 5,
                'details_required' => 1,
                'rate' => null,
            ],
            5 => [
                'name' => 'Lamination(Photo)',
                'status' => 1,
                'rank' => 6,
                'details_required' => 1,
                'rate' => null,
            ],
            6 => [
                'name' => 'Cup Print',
                'status' => 1,
                'rank' => 7,
                'details_required' => 1,
                'rate' => null,
            ],
            7 => [
                'name' => 'Magic Cup',
                'status' => 1,
                'rank' => 8,
                'details_required' => 1,
                'rate' => null,
            ],

            8 => [
                'name' => 'Photocopy',
                'status' => 1,
                'rank' => 9,
                'details_required' => 0,
                'rate' => 5,
            ],
            9 => [
                'name' => 'Lamination(Documents)',
                'status' => 1,
                'rank' => 10,
                'details_required' => 0,
                'rate' => 30,

            ],
            
            10 => [
                'name' => 'SIM Card',
                'status' => 1,
                'rank' => 12,
                'details_required' => 0,
                'rate' => 100,

            ],
            11 => [
                'name' => 'EDV',
                'status' => 1,
                'rank' => 13,
                'details_required' => 0,
                'rate' => 250,
            ],
            12 => [
                'name' => 'Others',
                'status' => 1,
                'rank' => 14,
                'details_required' => 0,
                'rate' => 0,
            ],





        ]);
    }
}
