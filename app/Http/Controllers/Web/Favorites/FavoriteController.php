<?php

namespace App\Http\Controllers\Web\Favorites;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Favorite\FavListResource;
use App\Models\favorites;


class FavoriteController extends Controller
{

    public function index() 
    {   
        // ->where('user_id' , $user->id)
        $user = auth()->user() ; 
        $favorites = favorites::with('product')->get() ; 
        if($user->id) 
        {
            return $this->apiResponse(FavListResource::collection($favorites), 'Favorites Retrieved Successfully' , 200) ;
        }
    }
    public function addToFavorites(Request $request, $productId)
    {
        $user = auth()->user(); 
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $user->favoriteProducts()->attach($productId);
    

    
        return response()->json(['message' => 'Product added to favorites'], 200);
    }
    public function removeFromFavorites(Request $request, $productId)
    {
        $user = auth()->user(); 
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        if (!$user->favoriteProducts()->where('product_id', $productId)->exists()) {
        return response()->json(['message' => 'Product is not in your favorites'], 404);
        }
        $user->favoriteProducts()->detach($productId);
        return response()->json(['message' => 'Product removed from favorites'], 200);
    }

}
