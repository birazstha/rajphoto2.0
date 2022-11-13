<?php

namespace Database\Seeders;

use App\Model\FrontendUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ExpenseSeeder extends Seeder
{

    public function run()
    {
        
        \DB::table('expenses')->insert([
            0 => [
                'title' => 'Lunch',
                'status' => 1,
            ],
            1 => [
                'title' => 'Breakfast',
                'status' => 1,
            ],
            2 => [
                'title' => 'Other',
                'status' => 1,
            ],
            

        ]);
    }
}
