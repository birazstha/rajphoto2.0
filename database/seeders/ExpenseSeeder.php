<?php

namespace Database\Seeders;

use App\Model\Expense;
use App\Model\FrontendUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ExpenseSeeder extends Seeder
{

    public function run()
    {
        Expense::firstOrCreate([
            'title' => 'Lunch',
            'status' => 1,
        ]);

        Expense::firstOrCreate([
            'title' => 'Breakfast',
            'status' => 1,
        ]);

        Expense::firstOrCreate([
            'title' => 'Bill Paid',
            'status' => 1,
        ]);
        Expense::firstOrCreate([
            'title' => 'Other',
            'status' => 1,
        ]);
    }
}
