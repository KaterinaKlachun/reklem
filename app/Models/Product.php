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
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с цветами товара
    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }

    // Связь с услугами через категорию
    public function services()
    {
        return $this->category->services();
    }

}
