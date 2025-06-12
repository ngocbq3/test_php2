<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController
{
    //Danh sách sản phẩm
    public function index()
    {
        $products = Product::allProduct();
        return view('index', compact('products'));
    }

    //form thêm mới
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    //Lưu dữ liệu thêm mới
    public function store()
    {
        $data = $_POST;

        //Xử lý ảnh
        if (is_upload('img_thumbnail')) {
            $file = $_FILES['img_thumbnail'];
            $image = upload_file($file, 'images');
            //add image vào data
            $data['img_thumbnail'] = $image;
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        Product::create($data);
        return redirect('products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('edit', compact('product', 'categories'));
    }
}
