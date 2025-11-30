<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Một đánh giá thuộc về 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Một đánh giá thuộc về 1 Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}