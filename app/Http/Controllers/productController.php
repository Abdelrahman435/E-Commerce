<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        return response()->json($this->service->list($request));
    }

    public function store(ProductStoreRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        return response()->json(
            $this->service->update($product, $request->validated())
        );
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return response()->json(['message' => 'Deleted']);
    }

    public function show(Product $product)
    {
        $product = $this->service->find($product->id);
        return response()->json($product);
    }
}
