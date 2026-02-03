<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Category;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::where('status', 'available')->with(['brand', 'category']);

        // Search
        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('brand', function($bq) use ($search) {
                      $bq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($brand = $request->query('brand')) {
            if ($brand !== 'all') {
                $query->whereHas('brand', function($bq) use ($brand) {
                    $bq->where('name', $brand);
                });
            }
        }

        if ($type = $request->query('type')) {
            if ($type !== 'all') {
                $query->whereHas('category', function($cq) use ($type) {
                    $cq->where('name', $type);
                });
            }
        }

        if ($year = $request->query('year')) {
            if ($year !== 'all') {
                $query->where('year', $year);
            }
        }

        $minPrice = $request->query('min_price', 0);
        $maxPrice = $request->query('max_price', 10000000000); // 10 Billion default max?
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        // Sorting
        $sort = $request->query('sort', 'default');
        switch ($sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'year-desc':
                $query->orderBy('year', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $cars = $query->paginate(12)->withQueryString();

        // Data for filters
        $brands = Brand::pluck('name')->toArray();
        $carTypes = Category::pluck('name')->toArray();
        $years = Car::select('year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();

        return view('cars.index', [
            'cars' => $cars,
            'brands' => $brands,
            'carTypes' => $carTypes,
            'years' => $years,
            'filters' => [
                'search' => $search,
                'brand' => $brand,
                'type' => $type,
                'year' => $year,
                'min_price' => $minPrice,
                'max_price' => $maxPrice,
                'sort' => $sort,
            ]
        ]);
    }

    public function show($id)
    {
        $car = Car::with(['brand', 'category'])->findOrFail($id);

        return view('cars.show', compact('car'));
    }
}
