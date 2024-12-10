<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0', 
            'payment_method' => 'required|string|in:cach,tap,fawry,stripe', 
            'status' => 'required|string|in:paid,unpaid',
            'fees' => 'nullable|numeric|min:0', 
        ];
    }
}
