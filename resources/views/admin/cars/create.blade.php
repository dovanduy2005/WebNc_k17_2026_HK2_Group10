@extends('layouts.admin')

@section('title', 'Thêm xe mới - AutoLux Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.cars.index') }}" class="p-2 hover:bg-muted rounded-xl transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <h1 class="text-3xl font-bold">Thêm xe mới</h1>
    </div>

    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <!-- Basic Info -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-6">
            <h2 class="font-bold text-lg border-b pb-4">Thông tin cơ bản</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="font-medium text-sm">Tên xe <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    @error('name') <p class="text-destructive text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Giá bán (VNĐ) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    @error('price') <p class="text-destructive text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Thương hiệu <span class="text-red-500">*</span></label>
                    <input type="text" name="brand_name" list="brand_list" value="{{ old('brand_name') }}" required placeholder="Nhập hoặc chọn thương hiệu" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                    <datalist id="brand_list">
                        @foreach(\App\Models\Brand::all() as $brand)
                            <option value="{{ $brand->name }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Loại xe (Category) <span class="text-red-500">*</span></label>
                    <input type="text" name="category_name" list="category_list" value="{{ old('category_name') }}" required placeholder="Nhập hoặc chọn loại xe" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
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
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" required min="1900" max="{{ date('Y') + 1 }}" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Số chỗ ngồi <span class="text-red-500">*</span></label>
                    <input type="number" name="seats" value="{{ old('seats', 4) }}" required min="1" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>

                <div class="space-y-2">
                    <label class="font-medium text-sm">Động cơ</label>
                    <input type="text" name="engine" value="{{ old('engine') }}" placeholder="VD: V8 4.0L" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                </div>
                
                 <div class="space-y-2">
                    <label class="font-medium text-sm">Trạng thái <span class="text-red-500">*</span></label>
                    <select name="status" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Đang bán</option>
                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Đã bán</option>
                    </select>
                </div>
            </div>

                <label class="font-medium text-sm">Mô tả chi tiết</label>
                <textarea name="description" rows="5" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('description') }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="font-medium text-sm">Tính năng nổi bật (Mỗi tính năng 1 dòng)</label>
                <textarea name="features" rows="5" placeholder="- Camera 360&#10;- Cửa sổ trời&#10;- Ghế massage" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">{{ old('features') }}</textarea>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-card p-6 rounded-xl border shadow-sm space-y-6">
            <h2 class="font-bold text-lg border-b pb-4">Hình ảnh</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Main Image -->
                <div class="space-y-4">
                    <label class="font-medium text-sm">Ảnh đại diện (Main) <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-4">
                        <div class="w-32 h-20 rounded-lg border-2 border-dashed border-muted-foreground/25 flex items-center justify-center overflow-hidden bg-muted/50" id="main-image-preview-container">
                            <span class="text-xs text-muted-foreground">Preview</span>
                        </div>
                        <input type="file" name="image_file" required accept="image/*" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-primary-foreground hover:file:bg-primary/90" onchange="previewMainImage(this)">
                    </div>
                </div>

                <!-- Gallery -->
                <div class="space-y-4">
                    <label class="font-medium text-sm">Ảnh chi tiết (Gallery) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="file" name="images_files[]" multiple required accept="image/*" class="hidden" id="gallery-input" onchange="previewGalleryImages(this)">
                        <label for="gallery-input" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-muted-foreground/25 rounded-xl cursor-pointer bg-muted/5 hover:bg-muted/10 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-muted-foreground" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-muted-foreground"><span class="font-bold">Click để tải lên</span> hoặc kéo thả</p>
                                <p class="text-xs text-muted-foreground">Giữ Ctrl chọn nhiều ảnh (Tối đa 5MB/ảnh)</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Previews -->
            <div class="grid grid-cols-4 md:grid-cols-6 gap-4" id="gallery-preview-container">
                <!-- Previews will appear here -->
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.cars.index') }}" class="px-6 py-2 rounded-xl border font-bold hover:bg-muted transition-colors">Hủy bỏ</a>
            <button type="submit" class="px-6 py-2 rounded-xl bg-primary text-primary-foreground font-bold hover:shadow-lg transition-all">Lưu thông tin</button>
        </div>
    </form>
</div>

<script>
    function previewMainImage(input) {
        const container = document.getElementById('main-image-preview-container');
        container.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                container.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
             container.innerHTML = '<span class="text-xs text-muted-foreground">Preview</span>';
        }
    }

    function previewGalleryImages(input) {
        const container = document.getElementById('gallery-preview-container');
        container.innerHTML = ''; // Clear current previews

        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative w-full h-24 rounded-lg overflow-hidden border bg-background group';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover';
                    
                    div.appendChild(img);
                    container.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endsection
