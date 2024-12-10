<?php

namespace App\Http\Controllers\Web\Order;
use App\Models\Order;
use App\Factories\PaymentFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;



class OrderController extends Controller
{
    public function checkout(OrderRequest $orderRequest)
    {
     
    // 'user_id', 'total_price', 'payment_method', 'status' , 'fees'
        $paymentMethod = PaymentFactory::createPaymentMethod($orderRequest->payment_method);
        if (!$paymentMethod) {        return response()->json([
                'message' => 'Invalid payment method.',
            ], 400); 
        }
        $paymentResult = $paymentMethod->pay([
            'user_id' => $orderRequest->user_id , 
            'total_price' => $orderRequest->total_price , 
            'payment_method' => $orderRequest->payment_method ,
            'fees' => $orderRequest->fees 
        ]);
    
        if (!$paymentResult) {
            return response()->json([
                'message' => 'Payment failed.',
            ], 400);
        }
    }
}