<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'article', 'stock', 'price', 'description'
    ];

    // Связь с таблицей categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }
}
