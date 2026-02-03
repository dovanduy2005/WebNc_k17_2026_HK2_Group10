@extends('layouts.admin')

@section('title', 'Cập nhật xe - AutoLux Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.cars.index') }}" class="p-2 hover:bg-muted rounded-xl transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-bold">Cập nhật: {{ $car->name }}</h1>
    </div>

    <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Basic Info -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-6">
            <h2 class="font-bold text-lg border-b pb-4">Thông tin cơ bản</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="font-medium text-sm">Tên xe <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $car->name) }}" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Giá bán (VNĐ) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $car->price) }}" required min="0" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Thương hiệu <span class="text-red-500">*</span></label>
                    <input type="text" name="brand_name" list="brand_list" value="{{ old('brand_name', $car->brand->name ?? '') }}" required placeholder="Nhập hoặc chọn thương hiệu" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <datalist id="brand_list">
                        @foreach(\App\Models\Brand::all() as $brand)
                            <option value="{{ $brand->name }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Loại xe (Category) <span class="text-red-500">*</span></label>
                    <input type="text" name="category_name" list="category_list" value="{{ old('category_name', $car->category->name ?? '') }}" required placeholder="Nhập hoặc chọn loại xe" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <datalist id="category_list">
                         @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->name }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <!-- Specs -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-6">
            <h2 class="font-bold text-lg border-b pb-4">Thông số kỹ thuật</h2>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="font-medium text-sm">Năm sản xuất <span class="text-red-500">*</span></label>
                    <input type="number" name="year" value="{{ old('year', $car->year) }}" required min="1900" max="{{ date('Y') + 1 }}" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Số chỗ ngồi <span class="text-red-500">*</span></label>
                    <input type="number" name="seats" value="{{ old('seats', $car->seats) }}" required min="1" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Động cơ</label>
                    <input type="text" name="engine" value="{{ old('engine', $car->engine) }}" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>
                
                 <div class="space-y-2">
                    <label class="font-medium text-sm">Trạng thái <span class="text-red-500">*</span></label>
                    <select name="status" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Đang bán</option>
                        <option value="sold" {{ old('status', $car->status) == 'sold' ? 'selected' : '' }}>Đã bán</option>
                    </select>
                </div>
            </div>

                <label class="font-medium text-sm">Mô tả chi tiết</label>
                <textarea name="description" rows="5" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('description', $car->description) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="font-medium text-sm">Tính năng nổi bật (Mỗi tính năng 1 dòng)</label>
                <textarea name="features" rows="5" placeholder="- Camera 360&#10;- Cửa sổ trời" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('features', $car->features ? implode("\n", $car->features) : '') }}</textarea>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-6">
            <h2 class="font-bold text-lg border-b pb-4">Hình ảnh</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Main Image -->
                <div class="space-y-2">
                    <label class="font-medium text-sm">Ảnh đại diện (Main)</label>
                    <input type="file" name="image_file" accept="image/*" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-primary-foreground hover:file:bg-primary/90">
                    @if($car->image)
                        <div class="mt-2 w-32 h-20 rounded-lg overflow-hidden border">
                            <img src="{{ Storage::url($car->image) }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>

                <!-- Gallery -->
                <div class="space-y-2">
                    <label class="font-medium text-sm">Thêm ảnh chi tiết (Gallery)</label>
                    <input type="file" name="images_files[]" multiple accept="image/*" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-primary-foreground hover:file:bg-primary/90">
                    <p class="text-xs text-muted-foreground">Giữ Ctrl để chọn nhiều ảnh. Ảnh mới sẽ được thêm vào bộ sưu tập hiện có.</p>
                    
                    @if($car->images && count($car->images) > 0)
                        <div class="mt-2 grid grid-cols-4 gap-2">
                            @foreach($car->images as $img)
                                <div class="relative w-full h-20 rounded-lg overflow-hidden border group">
                                    <img src="{{ Storage::url($img) }}" class="w-full h-full object-cover">
                                    <!-- Add delete single image button here if needed -->
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.cars.index') }}" class="px-6 py-2 rounded-xl border font-bold hover:bg-muted transition-colors">Hủy bỏ</a>
            <button type="submit" class="px-6 py-2 rounded-xl bg-primary text-primary-foreground font-bold hover:shadow-lg transition-all">Cập nhật xe</button>
        </div>
    </form>
</div>
@endsection
