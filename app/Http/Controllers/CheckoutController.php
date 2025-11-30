<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // 1. Lấy giỏ hàng
        $cart = session()->get('cart', []);
        
        // 2. Nếu giỏ rỗng thì đá về trang chủ (không cho vào checkout)
        if(count($cart) < 1) {
            return redirect('/')->with('error', 'Your cart is empty');
        }

        // 3. Tính tổng tiền
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('pages.checkout.index', compact('cart', 'total'));
    }

    // --- HÀM MỚI: XỬ LÝ LƯU ĐƠN HÀNG ---
    public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào (Bảo mật)
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|min:3',
            'address' => 'required|min:5',
            'phone' => 'required|numeric|min_digits:9',
            'payment_method' => 'required'
        ]);

        $cart = session()->get('cart', []);
        if(count($cart) < 1) return redirect()->route('checkout.index');

        // Tính tổng tiền lại (để bảo mật, tránh user sửa HTML gửi giá 0đ lên)
        $totalAmount = 0;
        foreach($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // 2. Dùng DB Transaction (Đảm bảo lưu thành công cả Đơn và Chi tiết, nếu lỗi thì hoàn tác hết)
        try {
            DB::beginTransaction();

            // A. Tạo Đơn hàng (Orders Table)
            $order = new Order();
            $order->user_id = auth()->id() ?? null; // Nếu có đăng nhập thì lưu ID
            $order->full_name = $request->full_name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->shipping_address = $request->address . ', ' . $request->city;
            $order->total_amount = $totalAmount;
            $order->payment_method = $request->payment_method;
            $order->status = 'pending';
            $order->save();

            // B. Tạo Chi tiết đơn hàng (Order Items Table)
            foreach($cart as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_name = $item['name'];
                $orderItem->color = $item['color'];
                $orderItem->size = $item['size'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->unit_price = $item['price'];
                $orderItem->total_price = $item['price'] * $item['quantity'];
                // $orderItem->product_variant_id = ... (Nếu bạn dùng DB thật thì query ID vào đây)
                $orderItem->save();
            }

            // C. Xóa giỏ hàng sau khi mua xong
            session()->forget('cart');

            DB::commit(); // Chốt đơn

            // 3. Chuyển hướng sang trang Success
            return redirect()->route('checkout.success', ['order' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack(); // Có lỗi thì hủy hết
            return back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    // --- HÀM MỚI: HIỂN THỊ TRANG SUCCESS ---
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('pages.checkout.success', compact('order'));
    }
}