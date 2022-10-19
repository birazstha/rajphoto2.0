<?php

namespace App\Rules\system;


use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ReCaptcha implements Rule
{
    public function __construct()
    {
    }
   
    public function passes($attribute, $value)
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $value
        ]);

        return $response->json()["success"];
    }
   

    public function message()
    {
        return 'The google recaptcha is required.';
    }
}
