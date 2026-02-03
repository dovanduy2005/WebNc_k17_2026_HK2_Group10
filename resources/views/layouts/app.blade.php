<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Xe Sang Online - Luxury Cars')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground font-sans antialiased">
    <div id="app" class="relative min-h-screen flex flex-col">
        <x-header />
        
        <main class="flex-grow">
            @yield('content')
        </main>

        <x-footer />

        <!-- Success Message -->
        @if(session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="fixed top-24 right-4 z-[60] flex items-center gap-3 bg-primary text-primary-foreground px-6 py-4 rounded-2xl shadow-2xl border border-primary/20 animate-[slide-in-right_0.3s_ease-out]">
                <div class="w-8 h-8 rounded-lg bg-primary-foreground/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                </div>
                <div>
                    <p class="font-bold text-sm">Thành công!</p>
                    <p class="text-xs opacity-90">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        @endif
    </div>

    @stack('scripts')
</body>
</html>
