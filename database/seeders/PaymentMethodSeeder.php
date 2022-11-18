<?php

namespace Database\Seeders;

use App\Model\FrontendUser;
use App\Model\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directory = public_path() . '/uploads/payment-method';
        if (is_dir($directory) != true) {
            \File::makeDirectory($directory, $mode = 0755, true);
        }

        //Fonepay
        \File::copy(public_path('images/fonepay.png'), public_path('uploads/payment-method/fonepay.png'));
        PaymentMethod::create([
            'title' => 'Fonepay',
            'image' => 'fonepay.png',
            'status' => 1,
        ]);


        //eSewa
        \File::copy(public_path('images/esewa.png'), public_path('uploads/payment-method/esewa.png'));
        PaymentMethod::create([
            'title' => 'Esewa',
            'image' => 'esewa.png', 
            'status' => 1,
        ]);

         //Khalti
         \File::copy(public_path('images/khalti.png'), public_path('uploads/payment-method/khalti.png'));
         PaymentMethod::create([
             'title' => 'Fonepay',
             'image' => 'khalti.png',
             'status' => 1,
         ]);


    }
}
