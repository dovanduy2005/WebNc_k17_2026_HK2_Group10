# WebNC_K17_2026_HK2_Nhom10

Dự án Website bán xe ô tô (WebNC).

## Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## Hướng dẫn cài đặt (Terminal Commands)

Dưới đây là các lệnh cần chạy khi clone dự án về máy mới:

### 1. Cài đặt thư viện PHP và JS
```bash
composer install
npm install
```

### 2. Cấu hình môi trường (.env)
Copy file mẫu thành file cấu hình chính thức:
```bash
cp .env.example .env
```
Hoặc trên Windows (Command Prompt):
```cmd
copy .env.example .env
```

Sau đó mở file `.env` và cập nhật thông tin database:
```do
DB_DATABASE=ten_database_cua_ban
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Tạo Key ứng dụng
```bash
php artisan key:generate
```

### 4. Setup Database
Chạy migration và seeder để tạo bảng và dữ liệu mẫu (bao gồm tài khoản admin):
```bash
php artisan migrate --seed
```

### 5. Link Storage (Quan trọng cho ảnh)
Để hiển thị ảnh xe và banner, bắt buộc phải chạy lệnh này:
```bash
php artisan storage:link
```

### 6. Build Frontend Assets
```bash
npm run build
```

## Chạy dự án

Mở 2 terminal riêng biệt để chạy server:

Terminal 1 (Laravel Server):
```bash
php artisan serve
```

Terminal 2 (Vite Hot Reload - Tùy chọn, dùng khi dev):
```bash
npm run dev
```

Truy cập: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Tài khoản Admin mặc định

- **URL**: [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)
- **Email**: `admin@gmail.com`
- **Password**: `12345678`
