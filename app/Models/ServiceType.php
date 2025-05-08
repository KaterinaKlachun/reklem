<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = ['name', 'label', 'price', 'category'];

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class)
            ->withPivot('price')
            ->withTimestamps();
    }
}
