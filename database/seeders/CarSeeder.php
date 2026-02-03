<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Mercedes-Benz S-Class 2024',
                'brand' => 'Mercedes-Benz',
                'price' => 5200000000,
                'year' => 2024,
                'type' => 'Sedan',
                'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?w=800&q=80',
                    'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80',
                    'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800&q=80',
                ],
                'engine' => '3.0L I6 Turbo',
                'power' => '429 HP',
                'transmission' => 'Tự động 9 cấp',
                'fuel' => 'Xăng',
                'seats' => 5,
                'features' => ['Hệ thống lái tự động cấp 3', 'Nội thất da Nappa', 'Màn hình OLED 12.8 inch', 'Hệ thống âm thanh Burmester'],
                'description' => 'Đỉnh cao của sự sang trọng và công nghệ. Mercedes-Benz S-Class 2024 mang đến trải nghiệm lái xe hoàn hảo.',
                'is_hot' => true,
            ],
            [
                'name' => 'BMW X7 2024',
                'brand' => 'BMW',
                'price' => 6800000000,
                'year' => 2024,
                'type' => 'SUV',
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80',
                    'https://images.unsplash.com/photo-1556189250-72ba954cfc2b?w=800&q=80',
                ],
                'engine' => '4.4L V8 Twin-Turbo',
                'power' => '523 HP',
                'transmission' => 'Tự động 8 cấp',
                'fuel' => 'Xăng',
                'seats' => 7,
                'features' => ['Hệ thống treo khí nén', 'Cửa sổ trời toàn cảnh', 'Màn hình cong 14.9 inch', 'BMW Laser Light'],
                'description' => 'SUV hạng sang với không gian rộng rãi và hiệu suất vượt trội. Hoàn hảo cho gia đình hiện đại.',
                'is_hot' => true,
                'discount' => 5,
            ],
            [
                'name' => 'Audi e-tron GT 2024',
                'brand' => 'Audi',
                'price' => 5900000000,
                'year' => 2024,
                'type' => 'Sedan',
                'image' => 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80',
                ],
                'engine' => 'Động cơ điện kép',
                'power' => '637 HP',
                'transmission' => '2 cấp tự động',
                'fuel' => 'Điện',
                'seats' => 4,
                'features' => ['Sạc nhanh 270kW', 'Quattro AWD', 'Virtual Cockpit Plus', 'Bang & Olufsen 3D Sound'],
                'description' => 'Sedan điện hiệu suất cao với thiết kế tương lai. Trải nghiệm lái xe không khí thải.',
                'is_hot' => true,
            ],
            [
                'name' => 'Lexus LX 600 2024',
                'brand' => 'Lexus',
                'price' => 8100000000,
                'year' => 2024,
                'type' => 'SUV',
                'image' => 'https://images.unsplash.com/photo-1619682817481-e994891cd1f5?w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1619682817481-e994891cd1f5?w=800&q=80',
                ],
                'engine' => '3.5L V6 Twin-Turbo',
                'power' => '409 HP',
                'transmission' => 'Tự động 10 cấp',
                'fuel' => 'Xăng',
                'seats' => 7,
                'features' => ['Khung gầm TNGA-F', 'Multi-terrain Select', 'Mark Levinson Audio', 'Ghế massage'],
                'description' => 'SUV đầu bảng với khả năng off-road vượt trội và nội thất xa hoa bậc nhất.',
                'is_hot' => false,
                'discount' => 8,
            ],
            [
                'name' => 'VinFast VF 9 2024',
                'brand' => 'VinFast',
                'price' => 1530000000,
                'year' => 2024,
                'type' => 'SUV',
                'image' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800&q=80',
                'images' => [
                    'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?w=800&q=80',
                ],
                'engine' => 'Động cơ điện kép',
                'power' => '402 HP',
                'transmission' => '1 cấp tự động',
                'fuel' => 'Điện',
                'seats' => 7,
                'features' => ['Phạm vi 438km', 'ADAS nâng cao', 'Sạc nhanh DC', 'Smart Home kết nối'],
                'description' => 'SUV điện thương hiệu Việt với công nghệ hiện đại và giá thành cạnh tranh.',
                'is_hot' => true,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
