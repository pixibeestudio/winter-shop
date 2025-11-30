<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}