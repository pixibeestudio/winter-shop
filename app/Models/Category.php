<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Mối quan hệ: Một danh mục có nhiều Sản phẩm
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    // Tự động liên kết với danh mục con (nếu bạn phát triển đa cấp sau này)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}