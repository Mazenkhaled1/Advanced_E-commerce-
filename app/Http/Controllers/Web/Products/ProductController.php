<?php

namespace App\Http\Controllers\Web\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;

class ProductController extends Controller
{
    public function singleProduct($id) 
    {
        $singleProduct = Product::find($id) ;
        $user = auth()->user() ; 
        $data = $singleProduct; 
        $data['user_id'] = $user->id ;
        if($singleProduct) 
        {   
           
            return $this->apiResponse(new ProductResource( $data) , 'Product retrieved Successfully' , 202) ;
        }

        return $this->apiResponse(null , 'Product Not Found' , 404); 
    }
    
    public function filterProducts(Request $request)
{
    $user = Auth()->user() ; 
    $query = Product::query();
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }
 
    return ProductResource::collection($query->get());
}
}
