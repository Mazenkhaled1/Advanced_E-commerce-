<?php

namespace App\Http\Resources\Favorite;

use Illuminate\Http\Request;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FavListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this->id ,
            'product' => new ProductResource($this->whenLoaded('product'))  // de tare2a tanya 
            // 'title' => $this->product->title , 
            // 'description' => $this->product->description,  // de tare2a eny a3ml accss ala el products 
        ];  
    }
}
