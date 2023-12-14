@extends('normal-view.layout.base')

@section('title')
    | Confirm Order
@endsection

@section('content')
    <div class="container py-5">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <h2 class="text-color mb-4"><strong>Confirming...</strong></h2>
                <!-- Single item -->
                <div class="row">
                    <div class="col text-color2 text-start">Description</div>
                    <div class="col text-color2 text-end"></div>
                    <div class="col text-color2 text-end">Price</div>
                    <div class="col text-color2 text-end">Quantity</div>
                    <div class="col text-color2 text-end">Total</div>
                </div>
                <hr class="mb-4">
                <div class="row">
                    <div class="col text-end text-color2"><img src="{{ Storage::url($cart->product->product_image) }}"
                            class="d-block w-100" style="height: 90px;" alt="...">
                    </div>
                    <div class="col text-end text-color2"><strong>{{ $cart->product->product_name }}</strong>
                    </div>

                    <div class="col text-end text-color2">
                        <p>
                            &#8369;{{ number_format($cart->product->price, 2) }}
                        </p>
                    </div>
                    <div class="col text-end text-color2">
                        <p class="text-color2">x{{ $cart->cart_quantity }}</p>

                    </div>
                    <div class="col text-end text-color2">
                        &#8369;{{ number_format($cart->product->price * $cart->cart_quantity, 2) }}
                    </div>
                </div>

                <hr>
                <form action="{{ route('orders.create', $cart->product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="product_id" value="{{ $cart->product->id }}" hidden>
                    <input type="number" min="1" style="width: 80px;" value="{{ $cart->cart_quantity }}"
                        name="order_quantity" hidden>
                    <div class="d-flex justify-content-between">
                        <a href="#" onclick="goBack()" class="upt btn text-color2"><strong>Back</strong></a>
                        <button class="upt btn text-white" style="background: #894e32;" type="submit"><strong>Place order</strong></button>
                    </div>

                </form>
                <hr>
            </div>
        </div>
    </div>
@endsection


<style>
    .upt {
        border: 1px solid #894e32 !important;
    }

    .upt:hover {
        color: #894e32 !important;
        background: rgba(155, 146, 141, 0.245) !important;
    }
</style>
