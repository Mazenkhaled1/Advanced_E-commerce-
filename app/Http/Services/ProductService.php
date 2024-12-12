<?php

namespace App\Http\Services;

use App\Http\Resources\Products\ProductResource;
use Illuminate\Support\Str;
use App\Http\Requests\Product\ProductReqeust;
use App\Models\Product;

class ProductService 
{ 
    public function store( ProductReqeust $request ) 
    {
        $data = $request->validated() ; 
        if(isset($request->image))
            {
                $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension() ;  
                $request->image->move(public_path('images') , $imageName) ;
            }
            $data['image'] = url('images/'.$imageName) ?? null ;  
             $product = Product::create($data) ; 
            return [
                new ProductResource($product) 
            ] ; 
    }
    public function update( ProductReqeust $request , $id) 
    {
        $data = $request->validated() ; 
        dd($data) ; 
    }
    public function destroy($id) 
    {   
        $product = Product::find($id) ;
        if($product) 
        {
            $product->delete() ; 
            return " Product deleted successfully" ;
        }
        
        
    }
}