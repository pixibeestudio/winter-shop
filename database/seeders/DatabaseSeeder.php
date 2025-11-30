<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tắt kiểm tra khóa ngoại để xóa sạch dữ liệu cũ
        Schema::disableForeignKeyConstraints();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('reviews')->truncate();
        DB::table('product_images')->truncate();
        DB::table('product_variants')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Tạo Admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // 3. Tạo Danh mục (Link ảnh ổn định)
        $categories = [
            ['name' => 'Men Collection', 'slug' => 'men', 'image' => 'https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?q=80&w=400&auto=format&fit=crop'],
            ['name' => 'Women Collection', 'slug' => 'women', 'image' => 'https://images.unsplash.com/photo-1544022613-e87ca75a784a?q=80&w=400&auto=format&fit=crop'],
            ['name' => 'Winter Exclusives', 'slug' => 'winter', 'image' => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=400&auto=format&fit=crop'],
        ];

        $catIds = [];
        foreach ($categories as $cat) {
            $catIds[] = DB::table('categories')->insertGetId(array_merge($cat, [
                'created_at' => now(), 'updated_at' => now()
            ]));
        }

        // 4. DANH SÁCH ẢNH SẢN PHẨM (Link sống 100%)
        $productImages = [
            'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?q=80&w=600&auto=format&fit=crop', 
            'https://images.unsplash.com/photo-1544022613-e87ca75a784a?q=80&w=600&auto=format&fit=crop', 
            'https://images.unsplash.com/photo-1551488852-080175d27b87?q=80&w=600&auto=format&fit=crop', 
            'https://images.unsplash.com/photo-1539533018447-63fcce2678e3?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1559551409-dadc959f76b8?q=80&w=600&auto=format&fit=crop', 
            'https://images.unsplash.com/photo-1520975661595-6453be3f7070?q=80&w=600&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1504198458649-3128b932f49e?q=80&w=600&auto=format&fit=crop', 
            'https://images.unsplash.com/photo-1515434126000-961d90c046e7?q=80&w=600&auto=format&fit=crop', 
        ];

        $adjectives = ['Premium', 'Thermal', 'Ultra-Light', 'Heavy Duty', 'Luxury', 'Classic', 'Waterproof'];
        $types = ['Puffer Jacket', 'Parka', 'Trench Coat', 'Windbreaker', 'Bomber Jacket', 'Wool Coat'];

        // 5. Tạo 50 Sản phẩm
        for ($i = 1; $i <= 50; $i++) {
            $name = $adjectives[array_rand($adjectives)] . ' ' . $types[array_rand($types)] . ' ' . Str::random(3);
            
            $productId = DB::table('products')->insertGetId([
                'category_id' => $catIds[array_rand($catIds)],
                'name' => $name,
                'slug' => Str::slug($name) . '-' . $i,
                'description' => 'Áo khoác mùa đông chất lượng cao, thiết kế hiện đại, giữ ấm tốt.',
                'base_price' => rand(80, 300) + 0.99,
                'is_active' => 1,
                'is_featured' => ($i <= 10) ? 1 : 0,
                'created_at' => now(), 'updated_at' => now(),
            ]);

            // Ảnh
            $mainImg = $productImages[array_rand($productImages)];
            $secondImg = $productImages[array_rand($productImages)];

            DB::table('product_images')->insert([
                ['product_id' => $productId, 'image_path' => $mainImg, 'is_primary' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['product_id' => $productId, 'image_path' => $secondImg, 'is_primary' => 0, 'created_at' => now(), 'updated_at' => now()]
            ]);

            // Tạo biến thể (Size/Color)
            $colors = [
                ['name' => 'Black', 'hex' => '#000000'], 
                ['name' => 'Green', 'hex' => '#40513B'], 
                ['name' => 'Navy', 'hex' => '#1F2937']
            ];
            $sizes = ['S', 'M', 'L'];
            
            // Random chọn 2 màu
            foreach (array_rand($colors, 2) as $key) {
                $selectedColor = $colors[$key]; // Lấy object màu (gồm name và hex)
                
                foreach ($sizes as $size) {
                    // TẠO SKU DUY NHẤT: SKU-{ID}-{3 chữ cái đầu của Màu}-{Size}
                    // Ví dụ: SKU-1-BLA-S
                    $sku = 'SKU-' . $productId . '-' . strtoupper(substr($selectedColor['name'], 0, 3)) . '-' . $size;

                    DB::table('product_variants')->insert([
                        'product_id' => $productId,
                        'color' => $selectedColor['name'], // Lưu tên màu (Black)
                        'size' => $size,
                        'sku' => $sku, 
                        'stock_quantity' => rand(0, 20),
                        'created_at' => now(), 'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}