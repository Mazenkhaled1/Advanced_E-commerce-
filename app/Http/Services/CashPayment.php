<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Contracts\PaymentMethod;
use App\Http\Requests\Order\OrderRequest;

class CashPayment implements PaymentMethod
{
    public function pay(array $data): bool
    {
        // الحصول على المستخدم الحالي
        $user = auth()->user();
    
        // الحصول على محتويات السلة
        $cartItems = Cart::where('user_id', $user->id)->get();
    
        // التحقق إذا كانت السلة فارغة
        if ($cartItems->isEmpty()) {
            return false; // إرجاع false إذا كانت السلة فارغة
        }
    
        // تحديد متغيرات المجموعات
        $totalAmount = 0;
        $totalProducts = 0;
    
        // حساب التفاصيل الخاصة بكل منتج في السلة
        $productsDetails = $cartItems->map(function ($cartItem) use (&$totalAmount, &$totalProducts) {
            $product = Product::find($cartItem->product_id);
    
            // التحقق من وجود المنتج في قاعدة البيانات
            if (!$product) {
                return null; // إذا لم يتم العثور على المنتج، نرجع null
            }
    
            // حساب السعر الإجمالي لكل منتج
            $productTotal = $product->price * $cartItem->quantity;
            $totalAmount += $productTotal;
            $totalProducts += $cartItem->quantity;
    
            // إرجاع تفاصيل المنتج
            return [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => $cartItem->quantity,
                'price' => $product->price,
                'total_price' => $productTotal,
            ];
        })->filter(); // تصفية القيم null
    
        // التحقق إذا كانت تفاصيل المنتجات فارغة (أي أن أحد المنتجات غير موجود)
        if ($productsDetails->isEmpty()) {
            return false; // إرجاع false إذا كانت السلة تحتوي على منتجات غير موجودة
        }
    
        // إضافة الرسوم (مثل رسوم الشحن)
        $fees = 10;
    
        // إنشاء الطلب وتخزينه في قاعدة البيانات
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalAmount + $fees, // إضافة الرسوم إلى المبلغ الإجمالي
            'payment_method' => 'cash', // تحديد طريقة الدفع
            'status' => 'unpaid', // حالة الدفع
            'fees' => $fees, // إضافة الرسوم
        ]);
    
        // مسح الـ Cart بعد إتمام الدفع
        Cart::where('user_id', $user->id)->delete();
    
        // إرجاع true إذا تمت عملية الدفع بنجاح
        return true;
    }
}