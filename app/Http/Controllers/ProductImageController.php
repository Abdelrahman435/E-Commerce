<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductImageController extends Controller
{
    public function upload(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('product_images', 'public');

        $product->images()->create([
            'path' => $path,
        ]);

        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => $path,
        ]);
    }
}
