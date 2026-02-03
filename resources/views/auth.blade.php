@extends('layouts.app')

@section('title', 'Đăng nhập / Đăng ký - AutoLux')

@section('content')
<div class="min-h-screen bg-background flex" x-data="{ mode: 'login', showPassword: false }">
    <!-- Left - Form -->
    <div class="flex-1 flex items-center justify-center p-8 pt-32 lg:pt-8">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold">AutoLux</h1>
                    <p class="text-xs text-muted-foreground">Showroom Xe Cao Cấp</p>
                </div>
            </a>

            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2" x-text="mode === 'login' ? 'Đăng nhập' : 'Tạo tài khoản'"></h2>
                <p class="text-muted-foreground" x-text="mode === 'login' ? 'Đăng nhập để lưu xe yêu thích và theo dõi đơn hàng' : 'Đăng ký để trải nghiệm dịch vụ tốt nhất'"></p>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-destructive/10 border border-destructive/20 text-destructive rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form x-show="mode === 'login'" action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="text-sm font-medium mb-2 block">Email</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com" class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium mb-2 block">Mật khẩu</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input :type="showPassword ? 'text' : 'password'" name="password" required placeholder="••••••••" class="w-full pl-12 pr-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88 3.59 3.59"/><path d="m21 21-6.41-6.41"/><path d="M2 12s3-7 10-7 1.71 0 3.28.31"/><path d="M21 12s-3 7-10 7c-1.71 0-3.28-.31-4.88-.88"/><circle cx="12" cy="12" r="3"/><path d="m3 3 18 18"/></svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-primary-foreground h-14 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2">
                    <span>Đăng nhập</span>
                </button>
            </form>

            <!-- Register Form -->
            <form x-show="mode === 'register'" action="{{ url('/register') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="text-sm font-medium mb-2 block">Họ và tên</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nguyễn Văn A" class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium mb-2 block">Email</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com" class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium mb-2 block">Mật khẩu</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input :type="showPassword ? 'text' : 'password'" name="password" required placeholder="••••••••" class="w-full pl-12 pr-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium mb-2 block">Xác nhận mật khẩu</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" required placeholder="••••••••" class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-primary-foreground h-14 rounded-xl font-bold btn-primary-glow flex items-center justify-center gap-2">
                    <span>Đăng ký tài khoản</span>
                </button>
            </form>

            <!-- Toggle -->
            <div class="mt-8 text-center">
                <p class="text-muted-foreground">
                    <span x-text="mode === 'login' ? 'Chưa có tài khoản?' : 'Đã có tài khoản?'"></span>
                    <button @click="mode = (mode === 'login' ? 'register' : 'login')" class="ml-2 text-primary font-medium hover:underline">
                        <span x-text="mode === 'login' ? 'Đăng ký ngay' : 'Đăng nhập'"></span>
                    </button>
                </p>
            </div>
        </div>
    </div>

    <!-- Right - Image -->
    <div class="hidden lg:block flex-1 relative">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&q=80" alt="Luxury car" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-background via-background/50 to-transparent"></div>
        <div class="absolute bottom-16 left-16 max-w-md">
            <h3 class="text-3xl font-bold mb-4">Trải nghiệm đẳng cấp</h3>
            <p class="text-muted-foreground">
                Đăng ký tài khoản để lưu xe yêu thích, theo dõi đơn hàng và nhận ưu đãi độc quyền.
            </p>
        </div>
    </div>
</div>
@endsection
