<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 1. Khởi tạo Query (Chưa lấy dữ liệu ngay)
        $query = Product::with(['category', 'images'])->where('is_active', 1);

        if ($request->has('search') && $request->search != null) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // 2. Lọc theo Danh mục (nếu có trên URL ?category=slug)
        if ($request->has('category') && $request->category != null) {
            $slug = $request->category;
            $query->whereHas('category', function($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        // 3. Lọc theo Giá (nếu có ?min_price=10&max_price=100)
        if ($request->has('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        // 4. Sắp xếp (nếu có ?sort=price_asc)
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('base_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('base_price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('is_featured', 'desc'); // Mặc định hàng Hot lên đầu
            }
        } else {
            $query->orderBy('is_featured', 'desc');
        }

        // 5. Phân trang (Mỗi trang 12 món)
        $products = $query->paginate(12)->withQueryString();

        // 6. Lấy danh sách danh mục để hiện bên Sidebar
        $categories = Category::withCount('products')->get();

        return view('pages.shop.index', compact('products', 'categories'));
    }
}