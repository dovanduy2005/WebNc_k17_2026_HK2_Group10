<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập quản trị - AutoLux Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6">
        <div class="bg-card border rounded-2xl shadow-xl overflow-hidden p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h1 class="text-2xl font-bold">Quản Trị Hệ Thống</h1>
                <p class="text-muted-foreground mt-2">Đăng nhập để tiếp tục vào trang quản lý</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-destructive/10 border border-destructive/20 text-destructive rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="text-sm font-medium mb-2 block">Email quản trị</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@example.com" class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium mb-2 block">Mật khẩu</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-primary-foreground h-12 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                    <span>Truy cập Dashboard</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </form>
            
            <div class="mt-8 text-center">
                 <a href="{{ url('/') }}" class="text-sm text-muted-foreground hover:text-foreground">← Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
