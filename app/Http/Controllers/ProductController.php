<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function addProduct(Request $req)
    {
        $product= new Product;
        $product->name=$req->input('name');
        $product->description=$req->input('description');
        $product->price=$req->input('price');
        //$product->updated_at=$req->input('updated_at');
       // $product->created_at=$req->input('created_at');
       $product->file_path=$req->file('file')->store('products');
       $product->save();
        return $product;

    }
}
