<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->only(['search', 'min_price', 'max_price']);

        // Eager load user, comments with user, and images
        $products = Products::with(['user', 'comments.user', 'images'])
                    ->filter($filters)
                    ->get();

        return view('product.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        // Eager load relationships for show page
        $product->load(['user', 'comments.user', 'images']);

        return view('product.show', compact('product'));
    }

    /**
     * Optional: Store a newly created product
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Associate product with authenticated user
        $product = auth()->user()->products()->create($data);

        return redirect()->route('products.show', $product)
                         ->with('success', 'Product created successfully.');
    }

    /**
     * Optional: Update a product
     */
    public function update(Request $request, Products $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($data);

        return redirect()->route('products.show', $product)
                         ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
