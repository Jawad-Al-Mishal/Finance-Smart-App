<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // সব প্রোডাক্ট দেখানোর জন্য
    public function index()
    {
        return Product::orderBy('created_at', 'desc')->get();
    }

    // নতুন প্রোডাক্ট সেভ করা (ছবিসহ)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:51200',
        ]);

        // ছবি সেভ করা
        $imagePath = $request->file('image')->store('products', 'public');
        $imageUrl = asset('storage/' . $imagePath);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_url' => $imageUrl,
        ]);

        return response()->json(['message' => 'Product added!', 'product' => $product], 201);
    }

    // প্রোডাক্ট ডিলিট করা
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            // ফাইল মুছে ফেলা
            $oldPath = str_replace(asset('storage/'), '', $product->image_url);
            Storage::disk('public')->delete($oldPath);
            $product->delete();
            return response()->json(['message' => 'Deleted successfully']);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}