<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kost extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'location', 'available_room', 'image',
    ];

    protected $attributes = [
        'booked_room' => 0
    ];

    public function scopeName(Builder $query, string $name = null): Builder
    {
        if ($name) {
            return $query->where('name', 'like', '%' . $name .'%');
            
        }

        return $query;
    }

    public function scopeLocation(Builder $query, string $location = null): Builder
    {
        if ($location) {
            return $query->where('location', 'like', '%' . $location .'%');
        }

        return $query;
    }

    public function scopePrice(Builder $query, $harga_awal = null, $harga_akhir = null, $sortPrice = 'asc'): Builder
    {
        if ($harga_awal && $harga_akhir) {
            if ($sortPrice == "ALL") {
                return $query->whereBetween('price', [$harga_awal, $harga_akhir])
                    ->orderBy('price', 'asc');
            }
            return $query->whereBetween('price', [$harga_awal, $harga_akhir])
                ->orderBy('price', $sortPrice);
        }

        if ($sortPrice != "ALL") {
            return $query->orderBy('price', $sortPrice);
        }

        return $query;
    }
}
