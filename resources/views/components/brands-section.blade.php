@php
    $brands = [
        ['name' => 'Lamborghini', 'logo' => 'https://www.carlogos.org/car-logos/lamborghini-logo.png'],
        ['name' => 'Mercedes-Benz', 'logo' => 'https://www.carlogos.org/car-logos/mercedes-benz-logo.png'],
        ['name' => 'Porsche', 'logo' => 'https://www.carlogos.org/car-logos/porsche-logo.png'],
        ['name' => 'Lexus', 'logo' => 'https://www.carlogos.org/car-logos/lexus-logo.png'],
         ['name' => 'BMW', 'logo' => 'https://www.carlogos.org/car-logos/bmw-logo.png'],
       
    ];
@endphp

<section class="py-16 border-y border-border/50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-red-500 text-sm font-bold tracking-wide drop-shadow-md">
                Đối tác chính hãng từ các thương hiệu hàng đầu
            </span>
        </div>
        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-16">
            @foreach($brands as $brand)
                <div class="group flex items-center justify-center w-24 h-24 grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                    <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }}" class="max-w-full max-h-full object-contain">
                </div>
            @endforeach
        </div>
    </div>
</section>
