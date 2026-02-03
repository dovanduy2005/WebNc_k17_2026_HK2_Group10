@extends('layouts.app')

@section('title', 'Danh sách xe - AutoLux')

@section('content')
<div class="pt-32 pb-20">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-5xl font-bold mb-4">
                Danh sách <span class="text-gradient-accent">xe</span>
            </h1>
            <p class="text-muted-foreground max-w-lg mx-auto">
                Khám phá bộ sưu tập xe đa dạng từ các thương hiệu hàng đầu thế giới
            </p>
        </div>

        <!-- Search & Filter Bar -->
        <form action="{{ url('/cars') }}" method="GET" class="flex flex-col lg:flex-row gap-4 mb-8">
            <!-- Search -->
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-4 top-1/2 -translate-y-1/2 text-muted-foreground"><circle cx="11" cy="11" r="8"/><line x1="21" x2="16.65" y1="21" y2="16.65"/></svg>
                <input type="text" name="search" value="{{ $filters['search'] }}" placeholder="Tìm kiếm theo tên xe hoặc hãng..." class="w-full pl-12 h-12 bg-secondary border border-border rounded-xl focus:outline-none focus:ring-1 focus:ring-primary transition-all">
            </div>

            <!-- Sort -->
            <select name="sort" onchange="this.form.submit()" class="w-full lg:w-[200px] h-12 bg-secondary border border-border rounded-xl px-4 focus:outline-none focus:ring-1 focus:ring-primary">
                <option value="default" {{ $filters['sort'] == 'default' ? 'selected' : '' }}>Mặc định</option>
                <option value="price-asc" {{ $filters['sort'] == 'price-asc' ? 'selected' : '' }}>Giá: Thấp đến cao</option>
                <option value="price-desc" {{ $filters['sort'] == 'price-desc' ? 'selected' : '' }}>Giá: Cao đến thấp</option>
                <option value="year-desc" {{ $filters['sort'] == 'year-desc' ? 'selected' : '' }}>Mới nhất</option>
            </select>

            <button type="submit" class="bg-primary text-primary-foreground h-12 px-8 rounded-xl font-medium hidden lg:block">Tìm kiếm</button>
        </form>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <aside class="w-full lg:w-[280px] flex-shrink-0">
                <div class="card-luxury rounded-2xl p-6 sticky top-32">
                    <h3 class="text-lg font-semibold mb-6">Bộ lọc</h3>
                    <form action="{{ url('/cars') }}" method="GET" class="space-y-6">
                        @if($filters['search'])
                            <input type="hidden" name="search" value="{{ $filters['search'] }}">
                        @endif
                        @if($filters['sort'])
                            <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
                        @endif

                        <!-- Brand -->
                        <div>
                            <label class="text-sm font-medium mb-2 block">Hãng xe</label>
                            <select name="brand" onchange="this.form.submit()" class="w-full h-10 bg-secondary border border-border rounded-lg px-3 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="all">Tất cả hãng</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}" {{ $filters['brand'] == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="text-sm font-medium mb-2 block">Loại xe</label>
                            <select name="type" onchange="this.form.submit()" class="w-full h-10 bg-secondary border border-border rounded-lg px-3 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="all">Tất cả loại</option>
                                @foreach($carTypes as $type)
                                    <option value="{{ $type }}" {{ $filters['type'] == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Year -->
                        <div>
                            <label class="text-sm font-medium mb-2 block">Năm sản xuất</label>
                            <select name="year" onchange="this.form.submit()" class="w-full h-10 bg-secondary border border-border rounded-lg px-3 focus:outline-none focus:ring-1 focus:ring-primary">
                                <option value="all">Tất cả năm</option>
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $filters['year'] == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Reset -->
                        <a href="{{ url('/cars') }}" class="block w-full text-center border border-border hover:border-primary py-2 rounded-lg transition-colors text-sm">
                            Xóa bộ lọc
                        </a>
                    </form>
                </div>
            </aside>

            <!-- Cars Grid -->
            <div class="flex-1">
                @if(count($cars) > 0)
                    <p class="text-muted-foreground mb-6">
                        Hiển thị {{ count($cars) }} kết quả
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($cars as $car)
                            <x-car-card :car="$car" />
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20">
                        <p class="text-xl text-muted-foreground mb-4">
                            Không tìm thấy xe phù hợp
                        </p>
                        <a href="{{ url('/cars') }}" class="inline-block border border-border hover:border-primary px-6 py-2 rounded-lg transition-colors">
                            Xóa bộ lọc
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
