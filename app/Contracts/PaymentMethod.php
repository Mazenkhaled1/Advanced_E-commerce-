<?php
namespace App\Contracts;

use App\Http\Requests\Order\OrderRequest;

interface PaymentMethod
{
    public function pay(array $data ) ;
}