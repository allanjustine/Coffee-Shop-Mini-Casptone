@extends('normal-view.layout.base')

@section('title')
    | Login
@endsection

@section('content')
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <h3 class="text-color"><strong>Sign In Coffee Lovers</strong></h3>
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="row gy-3 overflow-hidden">
                        <div class="col-12">
                            <div class="form-outline mb-3">
                                <input type="email" class="form-control py-3 @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="email@example.com"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-outline mb-3">
                                <input type="password" class="form-control py-3 @error('password') is-invalid @enderror"
                                    name="password" id="password" value="{{ old('password') }}" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn text-white py-3" style="background: #382015;" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="/register" class="btn py-2 mt-1 text-decoration-none text-white"
                        style="background: #7b462e;">Sign up an account</a>
                </div>
            </div>
        </div>
    </section>
@endsection
