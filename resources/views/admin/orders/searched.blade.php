@extends('admin.layout.base')

@section('title')
    | @if ($search)
        Search result for "{{ $search }}"
    @else
        No orders found
    @endif
@endsection

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between">
            <h3 class="mb-4 text-color">Orders</h3>
            <button class="btn mb-4 text-white" style="background: #d09b71;" onclick="goBack()">Back</button>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                <form action="{{ route('admin.orders.search') }}" method="GET">
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
                <a href="/admin/orders/create" class="btn" style="background: #382015; color: white;">Add
                    Order
                </a>
            </div>

        </div>
        @if ($search)
            <div class="table-responsive">
                <table class="table table-warning">
                    <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile number</th>
                            <th>Date ordered</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->created_at->format('F d, Y') }}</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="btn text-white" style="background: #382015;">View orders</a></td>
                            </tr>
                            @include('admin.orders.view')
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">
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
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile number</th>
                            <th>Date ordered</th>
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
