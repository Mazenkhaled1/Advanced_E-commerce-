<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'price', 'image', 'quantity', 'status', 'category_id'];

    // Belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Many-to-Many relationship with Users (via Favorites table)
    public function usersFavorited()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }

    // Many-to-Many relationship with Users (via Cart table)
    public function usersInCart()
    {
        return $this->belongsToMany(User::class, 'carts')
                    ->withTimestamps();
    }
}
