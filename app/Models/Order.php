<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'comment', 'user_id'];

    // Связь с таблицей users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
