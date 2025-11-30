<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        // --- DỮ LIỆU GIẢ LẬP (MÔ PHỎNG DB) ---
        // Sau này bạn sẽ thay bằng: $product = Product::with(['variants', 'images'])->where('slug', $slug)->firstOrFail();
        
        $product = (object) [
            'id' => 1,
            'name' => 'Premium Thermal Puffer Jacket',
            'price' => 150.00, // Giá gốc
            'description' => 'Áo khoác giữ nhiệt cao cấp với công nghệ chống nước IPX5. Lớp lót lông vũ tự nhiên giúp giữ ấm cơ thể ở nhiệt độ -10 độ C. Thiết kế form rộng trendy phù hợp cho cả nam và nữ.',
            'rating' => 4.8,
            'reviews_count' => 128,
            'sku' => 'JK-WIN-2025',
            'category' => 'Men / Jackets',
        ];

        // Giả lập danh sách ảnh
        $images = [
            'https://pngimg.com/d/jacket_PNG8038.png', // Ảnh chính (Màu xanh)
            'https://pngimg.com/d/jacket_PNG8051.png', // Góc nghiêng
            'https://pngimg.com/d/jacket_PNG8058.png', // Màu khác
            'https://pngimg.com/d/jacket_PNG8048.png', // Chi tiết
        ];

        // Giả lập Biến thể (Quan trọng để xử lý Logic JS)
        // Logic: Màu Green có size M, L. Màu Black có size S, M.
        $variants = [
            [
                'id' => 101,
                'color' => 'Green',
                'color_code' => '#40513B', // Mã màu để hiện cái chấm tròn
                'size' => 'M',
                'price' => 150.00,
                'stock' => 10
            ],
            [
                'id' => 102,
                'color' => 'Green',
                'color_code' => '#40513B',
                'size' => 'L',
                'price' => 155.00, // Size to đắt hơn xíu
                'stock' => 5
            ],
            [
                'id' => 103,
                'color' => 'Black',
                'color_code' => '#000000',
                'size' => 'S',
                'price' => 150.00,
                'stock' => 0 // Hết hàng
            ],
            [
                'id' => 104,
                'color' => 'Black',
                'color_code' => '#000000',
                'size' => 'M',
                'price' => 150.00,
                'stock' => 20
            ]
        ];

        // Lấy danh sách màu và size duy nhất để hiển thị ra nút bấm
        $colors = array_unique(array_column($variants, 'color'));
        $sizes = array_unique(array_column($variants, 'size'));

        return view('pages.products.show', compact('product', 'images', 'variants', 'colors', 'sizes'));
    }
}