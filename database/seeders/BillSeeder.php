<?php

namespace Database\Seeders;

use App\Model\Bill;
use Illuminate\Database\Seeder;


class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Bill::factory()->count(10)->create();
    }
}