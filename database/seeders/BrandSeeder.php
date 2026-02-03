<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Toyota', 'Honda', 'Mercedes-Benz', 'BMW', 'Audi', 
            'Ford', 'Hyundai', 'Kia', 'Mazda', 'Lexus', 
            'Porsche', 'Land Rover', 'VinFast', 'Volvo', 'Peugeot'
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insertOrIgnore([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
