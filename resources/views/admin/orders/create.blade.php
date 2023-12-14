@extends('admin.layout.base')

@section('title')
    | Create
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4 text-color">Creating...</h3>
            <button class="btn mb-4 text-white" style="background: #d09b71;" onclick="goBack()">Back</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-6">
                <div class="card-body px-4 py-5 px-md-5">
                    <form method="POST" action="{{ route('admin.orders.create') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <div class="form-outline">
                                <select name="user_id" id="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror" name="user_id"
                                    autocomplete="user_id" autofocus>
                                    <option selected hidden value="">Select User</option>
                                    <option disabled>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="form-label" for="user_id">Select User</label>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The user field is required.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-outline">
                                <select name="product_id" id="product_id"
                                    class="form-select @error('product_id') is-invalid @enderror" name="product_id"
                                    autocomplete="product_id" autofocus>
                                    <option selected hidden value="">Select Product</option>
                                    <option disabled>Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label" for="product_id">Select Product</label>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The product field is required.</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-outline">
                                <input type="number" id="order_quantity"
                                    class="form-control @error('order_quantity') is-invalid @enderror" name="order_quantity"
                                    value="{{ old('order_quantity') }}" autocomplete="name" autofocus />
                                <label class="form-label" for="order_quantity">Order quantity</label>
                                @error('order_quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="form-outline">
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror" name="status"
                                    autocomplete="status" autofocus>
                                    <option selected hidden value="">Select status</option>
                                    <option disabled>Select status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Preparing">Preparing</option>
                                    <option value="Ongoing delivery">Ongoing delivery</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Paid">Paid</option>
                                </select>
                                <label class="form-label" for="status">Status</label>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn text-white btn-block" style="background: #382015;">
                            Create order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
