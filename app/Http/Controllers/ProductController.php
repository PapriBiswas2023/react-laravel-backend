<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
            // Check if a file was successfully uploaded
            if ($req->hasFile('file') && $req->file('file')->isValid()) {
                $product->file_path = $req->file('file')->store('products');
            } else {
                // Return an error response if file upload failed
                return response()->json(['error' => 'File upload failed.'], 500);
            }
        } catch (\Exception $e) {
            // Return an error response if an exception occurs during file upload
            return response()->json(['error' => 'File upload failed.'], 500);
        }

        // Save the product
        $product->save();

        // Return a JSON response
        return response()->json(['message' => 'Product added successfully', 'product' => $product], 201);
    }
}
