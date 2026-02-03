<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'brand_id', 'category_id', 'name', 'price', 'year', 'mileage', 'type', 
        'image', 'images', 'engine', 'power', 'transmission', 'fuel', 'seats',
        'description', 'is_hot', 'discount', 'features', 'status'
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'is_hot' => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
