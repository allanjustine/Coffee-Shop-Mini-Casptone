@extends('normal-view.layout.base')

@section('title')
    | My Oders
@endsection

@section('content')
    <div class="container py-5">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <h2 class="text-color mb-4"><strong>Shopping order</strong></h2>
                <!-- Single item -->
                <div class="row">
                    <div class="col text-color2 text-start">Description</div>
                    <div class="col text-color2 text-end"></div>
                    <div class="col text-color2 text-end">Price</div>
                    <div class="col text-color2 text-end">Quantity</div>
                    <div class="col text-color2 text-end">Total</div>
                    <div class="col text-color2 text-end">Status</div>
                </div>
                <hr class="mb-4">
                @forelse ($orders as $order)
                    <div class="row">
                        <div class="col text-end text-color2"><img src="{{ Storage::url($order->product->product_image) }}"
                                class="d-block w-100" style="height: 90px;" alt="...">
                        </div>
                        <div class="col text-end text-color2"><strong>{{ $order->product->product_name }}</strong>
                        </div>

                        <div class="col text-end text-color2">
                            <p>
                                &#8369;{{ number_format($order->product->price, 2) }}
                            </p>
                        </div>
                        <div class="col text-end text-color2">
                            <p>x{{ $order->order_quantity }}</p>
                        </div>
                        <div class="col text-end text-color2">
                            &#8369;{{ number_format($order->product->price * $order->order_quantity, 2) }}
                        </div>
                        <div class="text-end col">
                            @if ($order->status == 'Pending')
                                <p class="text-danger">Pending</p>
                            @elseif($order->status == 'Preparing')
                                <p class="text-color2">Preparing</p>
                            @elseif($order->status == 'Ongoing delivery')
                                <p class="text-color2">Ongoing delivery</p>
                            @elseif($order->status == 'Delivered')
                                <p class="text-color2">Delivered</p>
                            @else
                                <p class="text-success"><i class="far fa-check-double"></i> Paid</p>
                            @endif
                            @if ($order->status == 'Pending')
                                <a href="#" class="btn text-white" data-bs-toggle="modal"
                                    data-bs-target="#cancel{{ $order->id }}"
                                    style="background-color: #894e32 !important;"><strong>Cancel</strong></a>
                            @endif
                        </div>
                        @include('normal-view.orders.cancel')
                    </div>
                    <hr>
                @empty
                    <h3 class="text-center">No items in order.</h3>
                @endforelse
                {{ $orders->links('pagination::bootstrap-5') }}
                <div class="float-end text-color2"><strong>Grand total:
                        &#8369;{{ number_format(
                            $orders->sum(function ($order) {
                                return $order->product->price * $order->order_quantity;
                            }),
                            2,
                        ) }}
                    </strong>
                </div>
            </div>
        </div>
    </div>
@endsection
