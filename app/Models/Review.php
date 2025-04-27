<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
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
