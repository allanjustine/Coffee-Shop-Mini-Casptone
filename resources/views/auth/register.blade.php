@extends('normal-view.layout.base')

@section('title')
    | Register
@endsection

@section('content')
    <section class="bg-light p-3 p-md-4 p-xl-5 d-flex align-items-center justify-content-center">
        <div class="container col-md-5">
            <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                        <h3 class="text-color"><strong>Sign Up Coffee Lovers</strong></h3>
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row gy-3 overflow-hidden">
                    <div class="d-flex justify-content-center mb-2">
                        <img id="previewImg" src="/images/registerimg.png"
                            style="width: 100px; height: 100px; border: 3px solid black; object-fit: cover;"
                            class="img-fluid rounded-circle">
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="btn text-white" style="background: #382015;">
                            <label for="profile_image" class="form-label m-1" style="cursor: pointer;">Choose file</label>
                            <input id="profile_image" type="file"
                                class="form-control d-none pr-4 @error('profile_image') is-invalid @enderror"
                                name="profile_image" value="{{ old('profile_image') }}" accept="image/*"
                                autocomplete="profile_image" autofocus onchange="previewImage(event)">
                        </div>
                        @error('profile_image')
                            <span class="text-danger ml-1 mt-3" style="font-size: 13px;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname"
                                id="fname" value="{{ old('fname') }}" placeholder="First name">
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname"
                                id="lname" value="{{ old('lname') }}" placeholder="Last name">
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror"
                                name="gender" autocomplete="gender" autofocus>
                                <option selected hidden value="">Select Gender</option>
                                <option disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                id="address" value="{{ old('address') }}" placeholder="Address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                id="phone" value="{{ old('phone') }}" placeholder="Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="email@example.com" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" value="{{ old('password') }}" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-outline mb-3">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Confirm password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn py-3 text-white" style="background: #382015;" type="submit">Sign
                                Up</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="d-flex justify-content-center">
                <a href="/login" class="btn py-2 mt-1 text-decoration-none text-white"
                    style="background: #7b462e;">Already have an account</a>
            </div>
    </section>
@endsection

<script>
    function previewImage() {
        const previewImg = document.getElementById('previewImg');
        previewImg.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
