<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductReqeust extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                'title' => 'required|string|min:10|max:255',
                'description' => 'required|string|min:10|max:1000',
                'price' => 'required|numeric|min:0.01',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120', 
                'quantity' => 'required|integer|min:0', 
                'category_id' => 'required|exists:categories,id', 
        ];
    }
}
