<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function list($request)
    {
        $cacheKey = 'products:' . md5(json_encode($request->query()));

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            return Product::query()
                ->when($request->name, fn($q) => $q->where('title', 'like', "%{$request->name}%"))
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->with('images')
                ->paginate($request->get('per_page', 10));
        });
    }

    public function create(array $data)
    {
        return auth()->user()->products()->create($data);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)    
    {
        $product->delete();
        return true;
    }
    public function find($id)
{
    return Product::with(['images', 'comments'])->find($id);
}

}
