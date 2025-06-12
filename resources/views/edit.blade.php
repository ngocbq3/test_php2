@extends('layouts.app')

@section('title')
    Cập nhật sản phẩm
@endsection

@section('content')
    <div class="container w-60">
        <h1>Cập nhật sản phẩm</h1>
        <form action="{{ route("products/{$product->id}/update") }}" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" @selected($product->category_id == $cate->id)>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Img thumbnail</label> <br>
                <img src="{{ file_url($product->img_thumbnail) }}" width="120" alt=""> <br>
                <input type="file" name="img_thumbnail" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" rows="10" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
