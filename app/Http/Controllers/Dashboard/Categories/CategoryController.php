<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoriesService;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    public function store( CategoryRequest $request , CategoriesService $categoriesService)
    {
        return $this->success($categoriesService->store($request) , 'Category created Successfully');
    }

    public function update ($id , CategoryRequest $request , CategoriesService $categoriesService) 
    {
        return $this->success($categoriesService->update( $id, $request) , 'Category updated Successfully');

    }
    public function destroy($id , CategoriesService $categoriesService) 
    {
        return $this->success($categoriesService->destroy($id)) ;
    } 
}
