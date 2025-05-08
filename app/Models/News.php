<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'date',
    ];
}
