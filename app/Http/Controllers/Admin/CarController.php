<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with(['brand', 'category'])->latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.cars.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'engine' => 'nullable|string|max:255',
            'seats' => 'required|integer|min:1',
            'status' => 'required|in:available,sold',
            'image_file' => 'required|image|max:5120', // Main image
            'images_files' => 'required|array|min:1', // At least one gallery image
            'images_files.*' => 'required|image|max:5120', // Gallery images
            'description' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        // Find or Create Brand
        $brand = Brand::firstOrCreate(
            ['name' => $validated['brand_name']],
            ['slug' => \Illuminate\Support\Str::slug($validated['brand_name'])]
        );
        $validated['brand_id'] = $brand->id;
        unset($validated['brand_name']);

        // Find or Create Category
        $category = Category::firstOrCreate(
            ['name' => $validated['category_name']],
            ['slug' => \Illuminate\Support\Str::slug($validated['category_name'])]
        );
        $validated['category_id'] = $category->id;
        unset($validated['category_name']);

        // Set defaults for required string columns not in form
        $validated['type'] = $category->name; 
        $validated['power'] = $request->input('power', 'N/A');
        $validated['transmission'] = $request->input('transmission', 'Tự động');
        $validated['fuel'] = $request->input('fuel', 'Xăng');
        
        // Upload Main Image
        if ($request->hasFile('image_file')) {
            $validated['image'] = $request->file('image_file')->store('cars', 'public');
        }

        // Upload Gallery Images
        if ($request->hasFile('images_files')) {
            $images = [];
            foreach ($request->file('images_files') as $file) {
                $images[] = $file->store('cars', 'public');
            }
            $validated['images'] = $images;
        }

        // Process features from string to array
        if (isset($validated['features']) && is_string($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Thêm xe mới thành công!');
    }

    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        // Pass all for datalist suggestions if needed, though simple input is requested
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'engine' => 'nullable|string|max:255',
            'seats' => 'required|integer|min:1',
            'status' => 'required|in:available,sold',
            'image_file' => 'nullable|image|max:5120',
            'images_files.*' => 'nullable|image|max:5120',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        // Find or Create Brand
        $brand = Brand::firstOrCreate(
            ['name' => $validated['brand_name']],
            ['slug' => \Illuminate\Support\Str::slug($validated['brand_name'])]
        );
        $validated['brand_id'] = $brand->id;
        unset($validated['brand_name']);

        // Find or Create Category
        $category = Category::firstOrCreate(
            ['name' => $validated['category_name']],
            ['slug' => \Illuminate\Support\Str::slug($validated['category_name'])]
        );
        $validated['category_id'] = $category->id;
        unset($validated['category_name']);

        if ($request->hasFile('image_file')) {
            // Delete old
            if ($car->image) Storage::disk('public')->delete($car->image);
            $validated['image'] = $request->file('image_file')->store('cars', 'public');
        }

        if ($request->hasFile('images_files')) {
             $images = $car->images ?? [];
             foreach ($request->file('images_files') as $file) {
                $images[] = $file->store('cars', 'public');
            }
            $validated['images'] = $images;
        }

        // Process features from string to array
        if (isset($validated['features']) && is_string($validated['features'])) {
            $validated['features'] = array_filter(array_map('trim', explode("\n", $validated['features'])));
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Cập nhật thông tin xe thành công!');
    }

    public function destroy(Car $car)
    {
        // Delete images
        if ($car->image) Storage::disk('public')->delete($car->image);
        if ($car->images) {
            foreach ($car->images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Đã xóa xe khỏi hệ thống.');
    }
}
