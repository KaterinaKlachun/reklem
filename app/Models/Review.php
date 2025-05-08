<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use CrudTrait;
    use HasFactory;

    // Те поля, которые разрешено массово заполнять
    protected $fillable = [
        'name',
        'title',
        'text',
        'date',
        'rating',
    ];

    // Приведение типов
    protected $casts = [
        'date' => 'date',
    ];
}
