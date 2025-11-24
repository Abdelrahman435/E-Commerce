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
        $products = Products::query();
        $products->when(request('search'), function($query){
            $query->where('title', 'like', '%'. request('search') . '%')
                  ->orWhere('description', 'like', '%'. request('search') . '%');
        }) -> when(request('min_price'), function($query){
            $query->where('price', '>=', request('min_price'));
        }) -> when(request('max_price'), function($query){
            $query->where('price', '<=', request('max_price'));
        });
        return view('product.index', ['products' => $products->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product )
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
