<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
   
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
