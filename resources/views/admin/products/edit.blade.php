@extends('admin.layout.base')

@section('title')
    | Product Update
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4 text-color">Updating...</h3>
            <button class="btn mb-4 text-white" style="background: #d09b71;" onclick="goBack()">Back</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-7">
                <div class="card-body px-4 py-5 px-md-5">
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <div class="form-outline">
                                <div class="d-flex justify-content-center mb-2">
                                    <img id="previewImg" src="/images/icon.png"
                                        style="width: 100px; height: 100px; border: 3px solid black; object-fit: cover;"
                                        class="img-fluid rounded-circle">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="btn text-white" style="background: #382015;">
                                        <label for="product_image" class="form-label m-1" style="cursor: pointer;">Select
                                            product image</label>
                                        <input id="product_image" type="file"
                                            class="form-control d-none pr-4 @error('product_image') is-invalid @enderror"
                                            name="product_image" value="{{ $product->product_image }}" accept="image/*"
                                            autocomplete="product_image" autofocus onchange="previewImage(event)">
                                    </div>
                                    @error('product_image')
                                        <span class="text-danger ml-1 mt-3" style="font-size: 13px;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-outline">
                                <input type="text" id="product_name"
                                    class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                    value="{{ $product->product_name }}" autocomplete="product_name" autofocus />
                                <label class="form-label" for="product_name">Product name</label>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-outline">
                                <input type="number" id="price"
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ $product->price }}" autocomplete="price" autofocus />
                                <label class="form-label" for="price">Price</label>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn text-white btn-block" style="background: #382015;">
                            Update product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function previewImage() {
        const previewImg = document.getElementById('previewImg');
        previewImg.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
