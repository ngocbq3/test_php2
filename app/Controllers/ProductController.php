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

        //Validate
        $errors = []; //để lưu các lỗi xảy ra khi validate
        if (trim($data['name']) == "") {
            $errors['name'] = "Bạn cần nhập tên sản phẩm";
        }

        //Xử lý ảnh
        if (is_upload('img_thumbnail')) {
            $file = $_FILES['img_thumbnail'];

            //mảng imgs chứa định dạng ảnh được phép
            $imgs = ['jpg', 'jpeg', 'png'];
            //Lấy định dạng của file
            $ext_file = pathinfo($file['name'], PATHINFO_EXTENSION);
            //Kiểm tra xem định dạng có được phép không
            if (in_array($ext_file, $imgs)) {
                $image = upload_file($file, 'images');
                //add image vào data
                $data['img_thumbnail'] = $image;
            } else {
                $errors['img_thumbnail'] = "Bạn chưa nhập đúng định dạng ảnh";
            }
        }

        if ($errors) {
            $categories = Category::all();
            return view('create', compact('categories', 'errors', 'data'));
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

    //lưu sửa
    public function update($id)
    {
        //Lấy sản phẩm cũ
        $product = Product::find($id);
        $data = $_POST; //lấy dữ liệu trên form

        //Xử lý ảnh
        if (is_upload('img_thumbnail')) {
            $file = $_FILES['img_thumbnail'];
            $image = upload_file($file, 'images');
            //add image vào data
            $data['img_thumbnail'] = $image;
        }
        $data['updated_at'] = date('Y-m-d H:i:s');

        Product::update($id, $data);

        //Xóa ảnh cũ
        if (is_upload('img_thumbnail')) {
            if (file_exists($product->img_thumbnail)) {
                unlink($product->img_thumbnail);
            }
        }
        return redirect('products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        Product::delete($id);
        if (file_exists($product->img_thumbnail)) {
            unlink($product->img_thumbnail);
        }
        redirect('products');
    }
}
