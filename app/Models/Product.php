<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = []; // Cho phép lưu mọi trường

    // Mối quan hệ: Một sản phẩm thuộc về một Danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Mối quan hệ: Một sản phẩm có nhiều Ảnh
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Mối quan hệ: Một sản phẩm có nhiều Biến thể (Màu/Size)
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}