@extends('admin.layout.base')

@section('title')
    | Dashboard
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4 text-color">Dashboard</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <a href="/admin/users">
                        <div class="card shadow">
                            <div class="card-body">
                                <h1 class="float-end mt-3"><strong>{{ App\Models\User::count() }}</strong></h1>
                                <h3><i class="far fa-users"></i></h3>
                                <h6 class="text-uppercase"><strong>Total Users</strong></h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <a href="/admin/products">
                        <div class="card shadow">
                            <div class="card-body">
                                <h1 class="float-end mt-3"><strong>{{ App\Models\Product::count() }}</strong></h1>
                                <h3><i class="far fa-mug-hot"></i></h3>
                                <h6 class="text-uppercase"><strong>Total Coffee</strong></h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <a href="/admin/orders">
                        <div class="card shadow">
                            <div class="card-body">
                                <h1 class="float-end mt-3"><strong>{{ App\Models\Order::count() }}</strong></h1>
                                <h3><i class="far fa-newspaper"></i></h3>
                                <h6 class="text-uppercase"><strong>Total Orders</strong></h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <a href="/admin/logs">
                        <div class="card shadow">
                            <div class="card-body">
                                <h1 class="float-end mt-3"><strong>{{ App\Models\Log::count() }}</strong></h1>
                                <h3><i class="far fa-chart-line"></i></h3>
                                <h6 class="text-uppercase"><strong>Total Logs</strong></h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7 mb-5">
                <h4 class="text-color"><strong><i class="far fa-history"></i> Activity Logs</strong></h4>
                <div class="card">
                    <div class="card-body p-0">
                        <a href="/admin/logs" class="btn float-end text-white my-2" style="background: #453608dd;">Load more</a>
                <table class="table table-warning shadow">
                    <thead>
                        <tr>
                            <th>ID.</th>
                            <th>Log Entry</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->log_entry }}</td>
                                <td>{{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No activity logs.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <h4 class="text-color"><strong><i class="far fa-history"></i> Recent orders</strong></h4>
                <div class="card shadow">
                    <div class="card-body p-0">
                        <a href="/admin/orders" class="btn float-end text-white my-2" style="background: #453608dd;">Load more</a>
                        <div class="table-responsive">
                            <table class="table table-warning">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Coffee</th>
                                        <th>Customer</th>
                                        <th>Time Stamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td><img style="widtd: 40px; height: 40px; margin-top: -10px;"
                                                    class="rounded-circle border"
                                                    src="{{ Storage::url($order->product->product_image) }}" alt="">
                                            </td>
                                            <td><strong>{{ $order->product->product_name }}</strong></td>
                                            <td>{{ $order->user->fname }} {{ $order->user->lname }}</td>
                                            <td>{{ $order->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No recent orders.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        background-color: #ffdf7edd !important;
        color: black !important;
    }
</style>
