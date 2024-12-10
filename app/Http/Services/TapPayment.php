<?php

namespace App\Services;

use App\Contracts\PaymentMethod;

class TapPayment implements PaymentMethod
{
    public function pay(array $data) : bool
    {
        return true ; 
    }
}