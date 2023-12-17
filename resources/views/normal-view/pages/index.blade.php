@extends('normal-view.layout.base')

@section('title')
    | Coffee Menu
@endsection

@section('content')
    <div class="hero-image d-flex justify-content-center align-items-center text-center">
    </div>
    <div class="container mt-2 mb-50">
        <div class="d-flex justify-content-between">
            <h2 class="text-color mt-4"><strong>Coffee Menu</strong></h2>
            <div class="col-md-4 mt-4">
                <form class="form-inline" action="{{ route('search') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search coffee..." aria-label="Search"
                            aria-describedby="button-addon2" name="search">
                        <div class="input-group-append">
                            <button class="btn text-white d-md-block d-none" style="background: #382015;" type="submit"
                                id="button-addon2"><i class="far fa-magnifying-glass"></i> Search...</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-0">
            @forelse ($allProducts as $product)
                <div class="col-md-4 col-lg-3 col-sm-6 mt-4 col-6">
                    <div class="card rounded-0">
                        <img src="{{ Storage::url($product->product_image) }}" class="d-block" alt="..."
                            style="width: 100%; height: 200px;">

                        <div class="media-body">
                            <h6 class="media-title font-weight-semibold">
                                <h5 class="text-color2 text-center"><strong>{{ $product->product_name }}</strong></h5>
                            </h6>
                        </div>

                        <div class="text-center">
                            <p><span class="text-color2" style="font-size: 12px;">From</span> <span class="text-color"><strong>&#8369;{{ number_format($product->price, 2) }}</strong></span></p>

                            <div class="d-flex justify-content-center">
                                <form action="{{ route('carts') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" hidden value="{{ $product->id }}" name="product_id">
                                    <button type="submit" class="btn rounded-0 text-white" style="background: #5b3523;">Add to cart</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center my-5 text-color"><i class="far fa-mug-hot"></i> Coffee is not available.</h5>
            @endforelse
        </div>
    </div>
@endsection


<style>
    .hero-image {
        background-image: url('/images/bg.png');
        background-size: cover;
        background-position: center;
        height: 50vh;
        position: relative;
        border-image: fill 0 linear-gradient(#beada23f, #beada233);
    }
</style>
