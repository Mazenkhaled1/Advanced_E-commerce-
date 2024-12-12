<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductReqeust;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    public function store (ProductReqeust $request , ProductService $productService ) 
    {
     return $this->success($productService->store($request) , 'product created successfully') ;
    }
    public function update (ProductReqeust $request  , $id ,  ProductService $productService ) 
    {
        return $this->success($productService->update($request , $id) , 'product created successfully') ;

    }
    public function destroy ($id , ProductService $productService) 
    {
        $product = $productService->destroy($id);

        if ($product) {
            return $this->apiResponse(null , $productService->destroy($id) ); 
        } 
            return $this->error(null, 'Product not found', 404);
    }
}
