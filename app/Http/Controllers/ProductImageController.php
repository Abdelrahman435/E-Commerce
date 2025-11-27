<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductImageRequest;

class ProductImageController extends Controller
{
 public function upload(ProductImageRequest $request, Product $product)
{
    $urls = [];

    foreach ($request->file('images') as $image) {
        $path = $image->store('product_images', 'public');

        $product->images()->create([
            'path' => $path,
        ]);

        $urls[] = asset('storage/' . $path);
    }

    return response()->json([
        'message' => 'Images uploaded successfully',
        'urls' => $urls,
    ]);
}

    public function destroy(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            return response()->json(['message' => 'Image does not belong to this product'], 403);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
