<?php

namespace App\Services;

use App\Contracts\PaymentMethod;

class FawryPayment implements PaymentMethod
{
    public function pay(array $data) : bool
    {
        return true ; 
    }
}