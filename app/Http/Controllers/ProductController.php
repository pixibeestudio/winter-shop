<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($slug)
    {
        // 1. Lấy sản phẩm từ DB kèm theo Quan hệ (Ảnh, Biến thể, Review, Danh mục)
        $product = Product::with(['images', 'variants', 'category', 'reviews.user'])
            ->withCount('reviews') // Đếm số review
            ->where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        // 2. Tính điểm đánh giá trung bình
        $avgRating = $product->reviews()->avg('rating') ?? 0;

        // 3. Xử lý Biến thể để lấy ra danh sách Màu và Size duy nhất
        // (Để hiển thị ra nút bấm cho khách chọn)
        $colors = $product->variants->unique('color')->pluck('color'); // VD: ['Green', 'Black']
        $sizes = $product->variants->unique('size')->pluck('size');    // VD: ['S', 'M', 'L']

        // 4. Lấy sản phẩm liên quan (Cùng danh mục)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(4)
            ->get();

        return view('pages.products.show', compact('product', 'colors', 'sizes', 'relatedProducts', 'avgRating'));
    }

    // Hàm lưu đánh giá mới
    public function storeReview(Request $request, $id)
    {
        // Kiểm tra xem user đã đăng nhập chưa
        if (!Auth::check()) {
            return back()->with('error', 'You need to login to review this product.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => 1 // Mặc định hiện luôn
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}