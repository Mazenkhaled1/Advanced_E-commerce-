<?php
namespace App\Factories;

use App\Services\CashPayment;
use App\Services\TapPayment;
use App\Services\StripePayment;
use App\Contracts\PaymentMethod;
use App\Services\FawryPayment;
 
class PaymentFactory
{
    public static function createPaymentMethod(string $paymentType): ?PaymentMethod
    {
        switch (strtolower($paymentType)) {
            case 'cash':
                return new CashPayment();
                case 'tap':
                    return new TapPayment();
                case 'fawry':
                    return new FawryPayment();
                case 'stripe':
                    return new StripePayment();
                default:
                return null;
            }
        }
    }
    