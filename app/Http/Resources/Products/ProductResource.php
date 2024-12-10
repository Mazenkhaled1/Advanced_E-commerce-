<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
        /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $image = isset($this->image) ? url('images/' . $this->image) : null ;
        return 
        [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'quantity'    => $this->quantity,
            'status'      => $this->status,
            'image'       => $image,
        ] ;
    }
}
