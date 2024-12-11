<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
      /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth()->user() ;
        return 
        [
            'id'       => $this->id,
            'name'     => $this->name,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'user_id'  => $user->id ?? null 

        ];
    }
}
