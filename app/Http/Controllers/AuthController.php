<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Dùng để xử lý chuỗi

class AuthController extends Controller
{
    // 1. Hiển thị Form Đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Xử lý Đăng nhập
    public function login(Request $request)
    {
        // Lấy thông tin (chưa validate kỹ để bạn sau này dễ test)
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // LOGIC CHECK ADMIN (Không phân biệt hoa thường)
            // Ví dụ: admin@gmail.com, Admin@Gmail.com đều được
            if (Str::lower($user->email) === 'admin@gmail.com') {
                return redirect()->route('admin.dashboard'); // Chuyển sang trang quản lý
            }

            // Khách thường thì về Shop
            return redirect()->route('shop.index');
        }

        // Đăng nhập sai
        return back()->with('error', 'Invalid email or password.');
    }

    // 3. Hiển thị Form Đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // 4. Xử lý Đăng ký
    public function register(Request $request)
    {
        // Tạo user mới (Mật khẩu đang hash để chạy được chức năng auth cơ bản của Laravel)
        // Sau này bạn có thể bỏ Hash::make nếu muốn test lưu password dạng plain text
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer' // Mặc định là khách
        ]);

        // Đăng nhập luôn sau khi đăng ký
        Auth::login($user);

        return redirect()->route('shop.index');
    }

    // 5. Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}