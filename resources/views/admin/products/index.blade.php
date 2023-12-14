@extends('admin.layout.base')

@section('title')
    | Admin Products
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4 text-color">Products</h3>

        <div class="d-flex justify-content-between">
            <div>
                <form action="{{ route('admin.products.search') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="search" name="search" class="form-control" style="width: 198px;" placeholder="Search"
                            aria-describedby="button-addon2">
                        <button class="btn text-white" style="background: #382015;" type="submit" id="button-addon2"><i
                                class="far fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div>
                <a href="/admin/products/create" class="btn" style="background: #382015; color: white;">Add
                    Product
                </a>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-warning">
                <thead>
                    <tr>
                        <th>ID.</th>
                        <th>Product image</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Sold</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <img style="width: 40px; height: 40px; margin-top: -10px;" class="rounded-circle border"
                                    src="{{ Storage::url($product->product_image) }}" alt="">
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>&#8369;{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->sold }}</td>
                            <td>
                                <a href="/admin/products/update/{{ $product->id }}" class="btn btn-primary mb-1"><i
                                        class="far fa-pen-to-square"></i> Edit</a>
                                <a href="#" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                    data-bs-target="#deleteProduct{{ $product->id }}"><i class="far fa-trash"></i>
                                    Delete</a>
                            </td>
                        </tr>
                        @include('admin.products.delete')
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">
                                No data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
