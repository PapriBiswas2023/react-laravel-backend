<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function addProduct(Request $req)
    {
        // Validate request data
        $validatedData = $req->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a new Product instance
        $product = new Product;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        // Handle file upload
        try {
            $product->file_path = $req->file('file')->store('products');
        } catch (\Exception $e) {
            return response()->json(['error' => 'File upload failed.'], 500);
        }

        // Save the product
        $product->save();

        // Return a JSON response
        return response()->json(['message' => 'Product added successfully', 'product' => $product], 201);
    }
}

