<?php

namespace App\Http\Controllers\Web\Cart;

use App\Jobs\Product_Out_Of_Stock_Job;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;

class CartController extends Controller
{

    public function index() 
    {   
        // ->where('user_id' , $user->id)
        $user = auth()->user() ; 
        $Carts = Cart::with('product')->get() ; 
        if($user->id) 
        {
            return $this->apiResponse(CartResource::collection($Carts), 'Cart Retrieved Successfully' , 200) ;
        }
    }
    public function addToCart(Request $request, $productId)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
       
        if ($product->quantity <= 0) {
            dispatch(new Product_Out_Of_Stock_Job($product )) ; 
            return response()->json(['message' => 'Product is out of stock'], 400);
        }
         
        $cartItem = $user->cartProducts()->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->pivot->increment('quantity');
        } else {
            $user->cartProducts()->attach($productId, [
                'quantity' => 1, 
            ]);
        }
        $product->decrement('quantity');  
        return response()->json(['message' => 'Product added to cart'], 200);
    }
    
    public function removeFromCart(Request $request, $productId)
    {
        $user = auth()->user();
        if (!$user) { 

            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $cartItem = $user->cartProducts()->where('product_id', $productId)->first();
        if (!$cartItem) {
        
            return response()->json(['message' => 'Product is not in your cart'], 404);
        }
        if ($cartItem->pivot->quantity > 1) {
            $cartItem->pivot->decrement('quantity');
            return response()->json(['message' => 'Product removed successfully'], 200);
        }
        $user->cartProducts()->detach($productId);
        $product->increment('quantity');
    
        return response()->json(['message' => 'Product removed from cart'], 200);
    }
     
}
