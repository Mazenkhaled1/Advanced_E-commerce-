<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Order;
use App\Models\Product;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password' , 'address' , 'phone_number' , 'image' ,'email_verified'] ;

    // Many-to-Many relationship with Products (via Favorites table)
    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites')
                    ->withTimestamps();
    }

    // Many-to-Many relationship with Products (via Cart table)
    public function cartProducts()
    {
        return $this->belongsToMany(Product::class, 'carts')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // One-to-Many relationship with Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    protected static function booted()
    {

        static::saving(function ($user) { // hena btstghal lw lesa mafesh data f h3ml save l new data k store aw ama a3mel update 
            if (is_null($user->address) || $user->address === '') {
                $user->is_banned = true;
            }
        });
        static::retrieved(function ($user) {    // de bstkhdmha lw b3ml login f b3ml retriev 34an a3ml check 
            if (is_null($user->address) || $user->address === '') {
                $user->is_banned = true;
                $user->save(); 
            }
        });
    }



}
