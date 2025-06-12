@extends('layouts.app')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <div class="container w-80">
        <h1>Danh sách sản phẩm</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Category Name</th>
                    <th>Name</th>
                    <th>Img thumbnail</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>
                        <a href="{{ route('products/create') }}" class="btn btn-primary">Create</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->cate_name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ file_url($product->img_thumbnail) }}" width="90" alt="">
                        </td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($product->created_at)) }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($product->updated_at)) }}</td>

                        <td>
                            <a href="{{ route("products/{$product->id}/edit") }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route("products/{$product->id}/delete") }}" class="btn btn-danger"
                                onclick="return confirm('Bạn có muốn xóa không?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
