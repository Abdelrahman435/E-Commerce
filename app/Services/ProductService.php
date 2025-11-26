<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function list($request)
    {
        $cacheKey = 'products:' . md5(json_encode($request->query()));

        return Cache::tags(['products'])->remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            return Product::query()
                ->when($request->title, fn($q) => $q->where('title', 'like', "%{$request->title}%"))
                ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
                ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
                ->with('images')
                ->paginate($request->get('per_page', 10));
        });
    }

    public function create(array $data)
    {
        Cache::tags(['products'])->flush();
        return auth()->user()->products()->create($data);
    }

    public function update(Product $product, array $data)
    {
        Cache::tags(['products'])->flush();
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        Cache::tags(['products'])->flush();
        $product->delete();
        return true;
    }
    public function find($id)
{
    return Product::with(['images', 'comments'])->find($id);
}

}
