<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Contracts\PaymentMethod;

class CashPayment implements PaymentMethod
{
    public function pay(array $data) : bool
    {
    //     $user      = auth()->user();
    //     $cartItems = Cart::where('user_id', $user->id)->get();
    
    //     if ($cartItems->isEmpty()) {
    //         return response()->json([
    //             'message' => 'Your cart is empty.',
    //         ], 400);
    //     }
    //     $totalAmount     = 0;
    //     $totalProducts   = 0;
    //     $productsDetails = $cartItems->map(function ($cartItem) use (&$totalAmount, &$totalProducts) {
    //     $product = Product::find($cartItem->product_id);
    //     if (!$product) {
    //         return null;
    //     }

    //     $productTotal   = $product->price * $cartItem->quantity;
    //     $totalAmount   += $productTotal;
    //     $totalProducts += $cartItem->quantity;

    //     return [
    //         'product_id'  => $product->id,
    //         'name'        => $product->name,
    //         'quantity'    => $cartItem->quantity,
    //         'price'       => $product->price,
    //         'total_price' => $productTotal,
    //     ];
    // })->filter(); 
    // if ($productsDetails->isEmpty()) { 
    //     return response()->json([
    //         'message' => 'One or more products in your cart do not exist.',
    //     ], 400);
    // }
    // $fees  = 10;
    // $order = Order::create([
    //     'user_id'        => $user->id,
    //     'total_price'    => $totalAmount + $fees,
    //     'payment_method' => $orderRequest->payment_method,
    //     'status'         => 'unpaid',
    //     'fees'           => $fees,
    // ]);


    //           // مسح الـ Cart بعد الدفع
    // Cart::where('user_id', $user->id)->delete();

    // return response()->json([
    //     'message' => 'Order placed successfully!',
    //     'order'   => $order,
    // ], 201);
     return true ; 
   }
}