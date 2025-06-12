<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    //Danh sách sản phẩm
    public function index()
    {
        $products = Product::allProduct();
        return view('index', compact('products'));
    }
}
