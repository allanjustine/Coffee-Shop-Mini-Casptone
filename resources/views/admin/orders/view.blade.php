<div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <h3><strong> {{ $user->fname }} {{ $user->lname }}&apos;s order</strong></h3>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h5><strong>Product image</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Product name</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Quantity</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Price</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Total price</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Status</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Date ordered</strong></h5>
                    </div>
                    <div class="col">
                        <h5><strong>Action</strong></h5>
                    </div>
                </div>
                <hr>
                @forelse ($user->orders as $order)
                    <div class="row mt-4">
                        <div class="col">
                            <img style="width: 40px; height: 40px; margin-top: -10px;" class="rounded-circle border"
                                src="{{ Storage::url($order->product->product_image) }}" alt="">
                        </div>
                        <div class="col">
                            <h6>{{ $order->product->product_name }}</h6>
                        </div>
                        <div class="col">
                            <h6>x{{ $order->order_quantity }}</h6>
                        </div>
                        <div class="col">
                            <h6>&#8369;{{ number_format($order->product->price, 2) }} </h6>
                        </div>
                        <div class="col">
                            <h6>&#8369;{{ number_format($order->product->price * $order->order_quantity, 2) }}</h6>
                        </div>
                        <div class="col">
                            <h6>
                                @if ($order->status == 'Pending')
                                    <span class="badge rounded-pill text-bg-danger">Pending</span>
                                @elseif ($order->status == 'Preparing')
                                    <span class="badge rounded-pill text-bg-primary">Preparing</span>
                                @elseif ($order->status == 'Ongoing delivery')
                                    <span class="badge rounded-pill text-bg-primary">Ongoing delivery</span>
                                @elseif ($order->status == 'Delivered')
                                    <span class="badge rounded-pill text-bg-success">Delivered</span>
                                @else
                                    <span class="badge rounded-pill text-bg-success">Paid</span>
                                @endif
                            </h6>
                        </div>
                        <div class="col">
                            <h6>{{ $order->created_at->format('F d, Y') }}</h6>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{ route('admin.orders.view.manage', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" hidden value="{{ $order->status }}">
                                @if ($order->status == 'Pending')
                                    <button type="submit" class="btn btn-primary">
                                        Mark as preparing</button>
                                @elseif ($order->status == 'Preparing')
                                    <button type="submit" class="btn btn-primary">
                                        Mark as ongoing delivery</button>
                                @elseif ($order->status == 'Ongoing delivery')
                                    <button type="submit" class="btn btn-primary">
                                        Mark as delivered</button>
                                @elseif ($order->status == 'Delivered')
                                    <button type="submit" class="btn btn-success">
                                        Mark as paid</button>
                                @else
                                    <a href="#" class="btn btn-success">
                                        <i class="far fa-check"></i> Paid</a>
                                @endif
                            </form>
                        </div>
                    </div>
                @empty
                    <h5 class="text-center">No orders yet.</h5>
                @endforelse
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
