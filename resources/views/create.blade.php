@extends('layouts.app')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')
    <div class="container w-60">
        <h1>Thêm mới sản phẩm</h1>
        <form action="{{ route('products/store') }}" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $data['name'] ?? '' }}" class="form-control">
                @isset($errors['name'])
                    <span class="text-danger">{{ $errors['name'] }}</span>
                @endisset
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}"
                            @isset($data['category_id'])
                                @selected($data['category_id'] == $cate->id)
                            @endisset>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Img thumbnail</label>
                <input type="file" name="img_thumbnail" id="" class="form-control">
                @isset($errors['img_thumbnail'])
                    <span class="text-danger">{{ $errors['img_thumbnail'] }}</span>
                @endisset
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" rows="10" class="form-control">{{ $data['description'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
