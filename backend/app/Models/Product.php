<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'brand',
        'category',
        'image_url',
        'price_cents',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
