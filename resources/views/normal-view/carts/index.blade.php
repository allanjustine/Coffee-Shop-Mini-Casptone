@extends('normal-view.layout.base')

@section('title')
    | Your Shopping Cart
@endsection

@section('content')
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <h2 class="text-color mb-4"><strong>Shopping cart</strong></h2>
                <!-- Single item -->
                <div class="row">
                    <div class="col text-color2 text-start">Description</div>
                    <div class="col text-color2 text-end"></div>
                    <div class="col text-color2 text-end">Price</div>
                    <div class="col text-color2 text-end">Quantity</div>
                    <div class="col text-color2 text-end">Total</div>
                </div>
                <hr class="mb-3">
                @forelse ($carts as $cart)
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
                            <form action="{{ route('update.cart', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" min="1" style="width: 80px;" value="{{ $cart->cart_quantity }}"
                                    name="cart_quantity" class="@error('cart_quantity') is-invalid @enderror">

                                <div class="d-flex justify-content-end mt-1">
                                    <button class="btn text-color2 upt" type="submit"><strong>Update</strong></button>
                                </div>

                                <a href="#" class="text-color2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $cart->id }}">Remove</a>
                            </form>
                        </div>
                        @include('normal-view.carts.remove')
                        <div class="col text-end text-color2">
                            &#8369;{{ number_format($cart->product->price * $cart->cart_quantity, 2) }}

                            <a href="/confirm-order/{{ $cart->id }}" class="btn text-white mt-5"
                                style="background-color: #894e32 !important;"><strong>Check out</strong></a>
                        </div>
                    </div>
                    <hr>
                @empty
                    <h3 class="text-center">No items in cart.</h3>
                @endforelse
                <div class="float-end text-color2"><strong>Grand total:
                        &#8369;{{ number_format(
                            $carts->sum(function ($cart) {
                                return $cart->product->price * $cart->cart_quantity;
                            }),
                            2,
                        ) }}
                    </strong>
                </div>
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
