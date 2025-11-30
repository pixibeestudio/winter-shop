<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Nhớ đảm bảo bạn đã có Model Product
// use App\Models\ProductVariant; // Mở comment nếu dùng DB thật

class CartController extends Controller
{
    // Lấy nội dung giỏ hàng hiện tại (để render ra Slide-over)
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        // Trả về HTML của riêng phần danh sách item (để JS thay thế vào)
        return view('partials.cart-sidebar', compact('cart', 'total'))->render();
    }

    // Thêm vào giỏ
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity;

        // 1. TÌM SẢN PHẨM THẬT TRONG DB (Kèm ảnh)
        $product = Product::with('images')->find($id);

        if(!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        // 2. LẤY ẢNH CHÍNH CỦA SẢN PHẨM
        // (Ưu tiên ảnh primary, nếu không có thì lấy ảnh đầu tiên, nếu không có nữa thì dùng ảnh rỗng)
        $primaryImage = $product->images->where('is_primary', 1)->first();
        $imageUrl = $primaryImage ? $primaryImage->image_path : ($product->images->first()->image_path ?? '');

        // 3. Xử lý giá (Nếu size L, XL tăng giá - Logic ví dụ)
        // Bạn có thể bỏ qua nếu không dùng logic tăng giá theo size
        $price = $product->base_price; 
        
        // --- XỬ LÝ SESSION CART ---
        $cart = session()->get('cart', []);
        
        // Tạo key duy nhất: ID_Màu_Size
        $cartKey = $id . '_' . $color . '_' . $size;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $price,
                "image" => $imageUrl, // <--- LƯU LINK ẢNH THẬT VÀO ĐÂY
                "color" => $color,
                "size" => $size
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
            'cart_html' => $this->index() // Render lại HTML giỏ hàng
        ]);
    }

    // Xóa khỏi giỏ
    public function remove(Request $request)
    {
        if($request->key) {
            $cart = session()->get('cart');
            if(isset($cart[$request->key])) {
                unset($cart[$request->key]);
                session()->put('cart', $cart);
            }
            
            return response()->json([
                'success' => true,
                'cart_count' => count($cart),
                'cart_html' => $this->index()
            ]);
        }
    }
}