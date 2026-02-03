<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContractSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $car = Car::first();

        if ($user && $car) {
            Contract::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
                'contract_number' => 'AL-2024-' . strtoupper(Str::random(6)),
                'cccd' => '001099001234',
                'phone' => $user->phone ?? '0912 345 678',
                'buyer_address' => $user->address ?? '80 Duy Tân, Dịch Vọng Hậu, Cầu Giấy, Hà Nội',
                'store_address' => 'Đại Học Phenikaa, Yên Nghĩa, Hà Đông, Hà Nội',
                'deposit_amount' => 300000000,
                'deposit_image' => null, // Placeholder for now
                'status' => 'signed',
                'signed_at' => now(),
            ]);
        }
    }
}
