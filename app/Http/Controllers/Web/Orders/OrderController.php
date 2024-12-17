<?php

namespace App\Http\Controllers\Web\Orders;

use App\Factories\PaymentFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;

class OrderController extends Controller
{
    public function checkout(OrderRequest $orderRequest)
    {
        dd(2);
        dd($orderRequest->payment_method);
        $paymentService = PaymentFactory::createPaymentMethod($orderRequest->payment_method);
        $data = $orderRequest->validated() ; 
        if (!$paymentService) {
            return response()->json([
                'message' => 'Invalid payment method.',
            ], 400);
        }
        $paymentResult = $paymentService->pay($data);
        if ($paymentResult) {
            return response()->json([
                'message' => 'Payment processed successfully!',
            ], 200);
        }

        return response()->json([
            'message' => 'Payment failed.',
        ], 400);
    
    }
}
