<header class="fixed top-0 left-0 right-0 z-50 bg-background/80 backdrop-blur-xl border-b border-border/50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-foreground">AutoLux</h1>
                    <p class="text-xs text-muted-foreground">Showroom Xe Cao Cấp</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-8">
                @php
                    $navLinks = [
                        ['name' => 'Trang chủ', 'path' => '/'],
                        ['name' => 'Danh sách xe', 'path' => '/cars'],
                        ['name' => 'Giới thiệu', 'path' => '/about'],
                        ['name' => 'Liên hệ', 'path' => '/contact'],
                        ['name' => 'Phản hồi', 'path' => '/feedback'],
                    ];
                @endphp

                @foreach($navLinks as $link)
                    <a href="{{ url($link['path']) }}" 
                       class="relative text-sm font-medium transition-colors duration-300 hover:text-primary {{ request()->is(ltrim($link['path'], '/')) || (request()->is('/') && $link['path'] == '/') ? 'text-primary' : 'text-muted-foreground' }}">
                        {{ $link['name'] }}
                        @if(request()->is(ltrim($link['path'], '/')) || (request()->is('/') && $link['path'] == '/'))
                            <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- CTA & User -->
            <div class="hidden lg:flex items-center gap-4">
                <a href="tel:02462918118" class="flex items-center gap-2 text-sm text-muted-foreground hover:text-foreground transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>024 6291 8118</span>
                </a>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 rounded-xl border border-border hover:bg-secondary transition-all hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span class="text-sm font-medium">Cá Nhân</span>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-card border border-border rounded-xl shadow-lg py-2 z-50">
                            <a href="{{ route('profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-secondary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Hồ sơ của tôi
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-primary hover:bg-secondary transition-colors font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                    Trang quản trị
                                </a>
                            @endif
                            <a href="{{ route('favorites') }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-secondary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                Xe yêu thích
                            </a>
                            <a href="{{ route('contracts') }}" class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-secondary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                                Hợp đồng của tôi
                            </a>
                            <div class="h-px bg-border my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-destructive hover:bg-secondary transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/auth') }}" class="bg-primary text-primary-foreground px-6 py-2 rounded-xl font-medium btn-primary-glow transition-all hover:scale-105 active:scale-95">
                        Đăng nhập
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="lg:hidden p-2 hover:bg-secondary rounded-lg transition-colors" x-data @click="$dispatch('toggle-mobile-menu')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="menu-icon"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-data="{ open: false }" 
         x-on:toggle-mobile-menu.window="open = !open" 
         x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden absolute top-full left-0 right-0 bg-background border-b border-border z-40"
         style="display: none;">
        <nav class="container mx-auto px-4 py-6 flex flex-col gap-4">
            @foreach($navLinks as $link)
                <a href="{{ url($link['path']) }}" 
                   class="text-lg font-medium py-2 px-4 rounded-lg transition-colors {{ request()->is(ltrim($link['path'], '/')) || (request()->is('/') && $link['path'] == '/') ? 'bg-primary text-primary-foreground' : 'text-foreground hover:bg-secondary' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach
            
            @auth
                <a href="{{ route('profile') }}" class="text-lg font-medium py-2 px-4 rounded-lg hover:bg-secondary">Cá Nhân</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-lg font-medium py-2 px-4 rounded-lg text-primary hover:bg-secondary">Trang quản trị</a>
                @endif
                <a href="{{ route('favorites') }}" class="text-lg font-medium py-2 px-4 rounded-lg hover:bg-secondary">Xe yêu thích</a>
                <a href="{{ route('contracts') }}" class="text-lg font-medium py-2 px-4 rounded-lg hover:bg-secondary">Hợp đồng của tôi</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-lg font-medium py-2 px-4 rounded-lg text-destructive hover:bg-secondary">Đăng xuất</button>
                </form>
            @else
                <div class="pt-4 border-t border-border">
                    <a href="{{ url('/auth') }}" class="block w-full text-center bg-primary text-primary-foreground py-3 rounded-xl font-medium btn-primary-glow">
                        Đăng nhập
                    </a>
                </div>
            @endauth
        </nav>
    </div>
</header>
