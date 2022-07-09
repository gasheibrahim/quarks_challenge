<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'detail', 'price', 'quantity', 'image'
    ];

    public function getImageAttribute($value)
    {
        return $value ? Storage::url($value) : $value;
    }
}
