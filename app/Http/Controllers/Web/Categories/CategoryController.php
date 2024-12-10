<?php

namespace App\Http\Controllers\Web\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;


class CategoryController extends Controller
{

        public function categoryWithProducts () 
        {
            $categoryWithProducts = Category::with('products')->get() ; 
            if($categoryWithProducts) 
            {
                return $this->apiResponse(CategoryResource::collection($categoryWithProducts) , 'Categroies  wiht its products retrieved successfully' , 202 ) ; 
            }
        }

        public function categories () 
        {
            $categories = Category::all() ; 
            return $this->apiResponse(CategoryResource::collection($categories) , 'Categroies retrieved successfully' , 202 ) ; 

        }

}
