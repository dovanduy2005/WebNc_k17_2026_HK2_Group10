<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$cars = \App\Models\Car::all();
foreach ($cars as $car) {
    echo "ID: {$car->id}, Name: {$car->name}\n";
    echo "  Main Image: {$car->image}\n";
    echo "  Storage URL: " . \Illuminate\Support\Facades\Storage::url($car->image) . "\n";
    if ($car->images) {
        echo "  Gallery: " . implode(', ', $car->images) . "\n";
    }
    echo "------------------\n";
}
