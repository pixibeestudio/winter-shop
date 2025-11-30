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
        $id = $request->id; // ID sản phẩm
        $color = $request->color;
        $size = $request->size;
        $quantity = $request->quantity;
        
        // --- LOGIC TÌM SẢN PHẨM (Mô phỏng vì bạn chưa nhập DB thật) ---
        // Khi có DB thật bạn sẽ dùng: $product = Product::find($id);
        // Ở đây mình fake dữ liệu giống bên ProductController để test chạy được luôn
        $product = (object) [
            'id' => 1,
            'name' => 'Premium Thermal Puffer Jacket',
            'price' => 150.00,
            'image' => 'https://pngimg.com/d/jacket_PNG8038.png'
        ];
        // Nếu chọn Size L giá tăng lên (logic giống trang detail)
        if($size == 'L') $product->price = 155.00; 

        // --- XỬ LÝ SESSION CART ---
        $cart = session()->get('cart', []);
        
        // Tạo key duy nhất cho sản phẩm theo biến thể (VD: 1_Green_M)
        $cartKey = $id . '_' . $color . '_' . $size;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "color" => $color,
                "size" => $size
            ];
        }

        session()->put('cart', $cart);

        // Trả về HTML giỏ hàng mới nhất để JS cập nhật
        return response()->json([
            'success' => true,
            'cart_count' => count($cart),
            'cart_html' => $this->index() // Gọi hàm index để lấy HTML mới
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