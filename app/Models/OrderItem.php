<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'color',
        'service_type',
        'service_price', // добавлено поле для цены услуги
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'float',
        'service_price' => 'float', // кастинг для правильного отображения
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function services()
    {
        return $this->belongsToMany(ServiceType::class)
            ->withPivot('price')  // цена услуги сохраняется в pivot
            ->withTimestamps();
    }
}
