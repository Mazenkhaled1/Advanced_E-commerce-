<?php

namespace App\Services;

use App\Contracts\PaymentMethod;

class StripePayment implements PaymentMethod
{
    public function pay(array $data) : bool
    {
        return true ; 
    }
}