@extends('admin.layout.base')

@section('title')
    | @if ($search)
        Search result for "{{ $search }}"
    @else
        No products found
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4 text-color">Products</h3>
            <button class="btn mb-4 text-white" style="background: #d09b71;" onclick="goBack()">Back</button>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <form action="{{ route('admin.products.search') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="search" name="search" class="form-control" style="width: 198px;" placeholder="Search"
                            aria-describedby="button-addon2" value="{{ $search }}">
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
        @if ($search)
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
            </div>
        @else
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
                        <tr>
                            <td colspan="6" class="text-center">
                                No data found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
