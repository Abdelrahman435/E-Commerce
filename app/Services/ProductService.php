<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected function cacheKey($request)
    {
        return 'products:' . md5(json_encode($request->query()));
    }

public function list($request)
{
    $cacheKey = $this->cacheKey($request);

    return Cache::store('redis')->remember($cacheKey, 600, function () use ($request) {
        $products = Product::query()
            ->when($request->title, fn($q) => $q->where('title', 'like', "%{$request->title}%"))
            ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
            ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
            ->with(['images', 'comments.user'])
            ->paginate($request->get('per_page', 10));

$products->getCollection()->transform(fn($product) => $this->transformProduct($product));

        return $products;
    });
}

    public function find($id)
    {
        $product = Product::with(['images', 'comments.user'])->findOrFail($id);

        return $this->transformProduct($product);
    }

    public function create(array $data)
    {
        $product = auth()->user()->products()->create($data);
        $this->clearCache();
        return $product;
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        $this->clearCache();
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
        $this->clearCache();
        return true;
    }

    protected function clearCache()
    {
        $keys = Cache::store('redis')->keys('products:*');
        foreach ($keys as $key) {
            Cache::store('redis')->forget($key);
        }
    }

protected function transformProduct($product)
{
    return [
        'id' => $product->id,
        'title' => $product->title,
        'description' => $product->description,
        'price' => $product->price,
        'stock' => $product->stock,
        'created_at' => $product->created_at,
        'updated_at' => $product->updated_at,
        'images' => $product->images->map(fn($img) => asset('storage/' . $img->path))->toArray(),
        'comments' => $product->comments->map(fn($c) => [
            'body' => $c->body,
            'user_name' => $c->user->name
        ])->toArray(),
    ];
}

}
