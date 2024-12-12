<?php

namespace App\Http\Services;

use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Admin;
use App\Models\Category;
use App\Traits\ApiResponse;

class CategoriesService
{
    use ApiResponse ; 
    public function store(CategoryRequest  $request) 
    {
        $data = $request->validated() ; 
        $admin = Admin::first() ; 
       $category = Category::create($data) ;
        return 
        [
            // 'category' =>  new CategoryResource($category)    de tare2a bas m3 key el data hb3t key esmo category zyada 
            new CategoryResource($category)   // w hena hykon fe only one key esmo data bas mengher category 
        ];
    }


    public function update($id , CategoryRequest $request ) 
    {

        $category = Category::find($id) ; 
        if($category) 
        {
            $data = $request->validated(); 
            $category->update($data) ; 
            return [
                    'category' => new CategoryResource($category)  
            ]; 
        }
    }

    public function destroy ($id) 
    {
        $category = Category::find($id) ; 
        if($category) 
        {
            $category->delete() ; 
            return 'category deleted successfully' ;
        }
    }
 }