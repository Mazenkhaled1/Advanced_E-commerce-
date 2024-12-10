<?php
namespace App\Contracts;

interface PaymentMethod
{
    public function pay(array $data) : bool;
}