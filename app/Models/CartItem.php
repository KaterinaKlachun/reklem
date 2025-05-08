<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'color', 'service_type', 'service_price'];

    // Связь с продуктом
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function services()
    {
        return $this->belongsToMany(ServiceType::class)
            ->withPivot('price')  // сохраняем цену услуги
            ->withTimestamps();
    }

}
