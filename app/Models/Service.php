<?php

// app/Models/Service.php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use CrudTrait;
    protected $fillable = [
        'title', 'short_description', 'description', 'image', 'advantages',
    ];

    protected $casts = [
        'advantages' => 'array', // Преобразуем преимущества в массив
    ];

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class)
            ->withPivot('price')
            ->withTimestamps();
    }

}
