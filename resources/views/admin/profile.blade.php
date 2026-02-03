@extends('layouts.admin')

@section('title', 'Thông tin cá nhân - Admin AutoLux')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-slide-up">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">Hồ sơ cá nhân</h1>
            <p class="text-muted-foreground italic">Quản lý thông tin tài khoản quản trị của bạn</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Avatar Side -->
        <div class="md:col-span-1">
            <div class="bg-card border rounded-2xl p-8 flex flex-col items-center text-center shadow-sm">
                <div class="relative group mb-6">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-primary/20 bg-muted">
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-primary">
                                <span class="text-4xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <label for="avatar_file" class="absolute bottom-0 right-0 w-10 h-10 bg-primary text-primary-foreground rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    </label>
                </div>
                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                <p class="text-sm text-muted-foreground">{{ $user->email }}</p>
                <div class="mt-4 px-3 py-1 bg-primary/10 text-primary border border-primary/20 rounded-full text-xs font-bold uppercase tracking-wider">
                    Administrator
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="md:col-span-2">
            <div class="bg-card border rounded-2xl p-8 shadow-sm">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="file" id="avatar_file" name="avatar_file" class="hidden" onchange="this.form.submit()">

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium">Họ và tên</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full h-11 bg-background border rounded-xl px-4 focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium">Email</label>
                            <input type="email" value="{{ $user->email }}" disabled class="w-full h-11 bg-muted border rounded-xl px-4 text-muted-foreground cursor-not-allowed">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium">Số điện thoại</label>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full h-11 bg-background border rounded-xl px-4 focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium">Địa chỉ công tác / Cá nhân</label>
                        <textarea name="address" rows="4" class="w-full bg-background border rounded-xl p-4 focus:ring-2 focus:ring-primary/20 outline-none transition-all">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="bg-primary text-primary-foreground px-8 py-2.5 rounded-xl font-bold shadow-lg shadow-primary/25 hover:scale-[1.02] active:scale-95 transition-all">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
