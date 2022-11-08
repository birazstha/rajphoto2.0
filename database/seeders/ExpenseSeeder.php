<?php

namespace Database\Seeders;

use App\Model\FrontendUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('expenses')->insert([
            0 => [
                'title' => 'Lunch',
                'status' => 1,
            ],
            1 => [
                'bank_name' => 'Breakfast',
                'status' => 1,
            ],

        ]);
    }
}
