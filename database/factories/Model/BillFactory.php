<?php

namespace Database\Factories\Model;

use App\Model\Bill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    protected $model = Bill::class;


    public function definition()
    {

        return [
            'name' => $this->faker->unique()->name,
            'grand_total' => $this->faker->randomDigit,
            'paid_amount' => $this->faker->randomDigit,
            'balance_amount' => $this->faker->randomDigit,
            'cash_received' => $this->faker->randomDigit,
            'ordered_date' => $this->faker->dateTime(Carbon::now()),
            'delivery_date' => $this->faker->dateTime(Carbon::now()),
            'qr_code' => \Str::random(13),
            'cash_return' => $this->faker->randomDigit,
            'user_id' => 1,
        ];
    }
}