<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Product; // <--- QUAN TRỌNG: Thêm dòng này để dùng được Product
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // 1. Lấy giỏ hàng
        $cart = session()->get('cart', []);
        
        if(count($cart) < 1) {
            return redirect('/')->with('error', 'Your cart is empty');
        }

        // 2. Tính tổng tiền
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Lấy danh mục (để header không lỗi)
        $categories = Category::withCount('products')->get();

        // 4. Lấy 3 sản phẩm mới nhất (ĐỂ SỬA LỖI "$products undefined" BẠN ĐANG GẶP)
        // Chúng ta lấy 3 sản phẩm ngẫu nhiên hoặc mới nhất để hiển thị vào cái khung "Recent Products"
        $products = Product::latest()->take(3)->get();

        // Truyền đủ biến sang View: cart, total, categories VÀ products
        return view('pages.checkout.index', compact('cart', 'total', 'categories', 'products'));
    }

    // --- CÁC HÀM XỬ LÝ LƯU ĐƠN HÀNG (GIỮ NGUYÊN) ---
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|min:3',
            'address' => 'required|min:5',
            'phone' => 'required|numeric|min_digits:9',
            'payment_method' => 'required'
        ]);

        $cart = session()->get('cart', []);
        if(count($cart) < 1) return redirect()->route('checkout.index');

        $totalAmount = 0;
        foreach($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        try {
            DB::beginTransaction();

            // A. Tạo Đơn hàng
            $order = new Order();
            $order->user_id = auth()->id() ?? null;
            $order->full_name = $request->full_name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->shipping_address = $request->address . ', ' . $request->city;
            $order->total_amount = $totalAmount;
            $order->payment_method = $request->payment_method;
            $order->status = 'pending';
            $order->save();

            // B. Tạo Chi tiết đơn hàng
            foreach($cart as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_name = $item['name'];
                $orderItem->color = $item['color'];
                $orderItem->size = $item['size'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->unit_price = $item['price'];
                $orderItem->total_price = $item['price'] * $item['quantity'];
                $orderItem->save();
            }

            // C. Xóa giỏ hàng
            session()->forget('cart');

            DB::commit();

            return redirect()->route('checkout.success', ['order' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    // Trang thành công
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        $categories = Category::withCount('products')->get(); 
        
        return view('pages.checkout.success', compact('order', 'categories'));
    }
}