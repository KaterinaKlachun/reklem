<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    protected $table = 'orders';

    protected $casts = [
        'total_price' => 'float',
    ];

    // Связь с пользователем
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Связь с товаром через OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
