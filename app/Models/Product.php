<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'user_id',
    ];

    // Product belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Product has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }

    // Product has many images
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // FILTER SCOPE
    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder
    {
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                          ->orWhere('description', 'like', "%$search%");
                });
            })
            ->when($filters['min_price'] ?? null, function ($query, $minPrice) {
                $query->where('price', '>=', $minPrice);
            })
            ->when($filters['max_price'] ?? null, function ($query, $maxPrice) {
                $query->where('price', '<=', $maxPrice);
            });
    }
}
