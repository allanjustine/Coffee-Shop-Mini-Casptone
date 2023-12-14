@extends('admin.layout.base')

@section('title')
    | User Create
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3 class="mb-4 text-color">Creating...</h3>
            <button class="btn mb-4 text-white" style="background: #d09b71;" onclick="goBack()">Back</button>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-md-7">
                <div class="card-body px-4 py-5 px-md-5">
                    <form method="POST" action="{{ route('admin.user.create') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-center mb-2">
                            <img id="previewImg" src="/images/registerimg.png"
                                style="width: 100px; height: 100px; border: 3px solid black; object-fit: cover;"
                                class="img-fluid rounded-circle">
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <div class="btn text-white" style="background: #382015;">
                                <label for="profile_image" class="form-label m-1" style="cursor: pointer;">Choose
                                    file</label>
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
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="fname"
                                        class="form-control @error('fname') is-invalid @enderror" name="fname"
                                        value="{{ old('fname') }}" autocomplete="fname" autofocus />
                                    <label class="form-label" for="fname">First name</label>
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="lname"
                                        class="form-control @error('lname') is-invalid @enderror" name="lname"
                                        value="{{ old('lname') }}" autocomplete="lname" autofocus />
                                    <label class="form-label" for="lname">Last name</label>
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <div class="form-outline">
                                    <input type="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus />
                                    <label class="form-label" for="email">Email address</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="address"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" autocomplete="address" autofocus />
                                    <label class="form-label" for="address">Address</label>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="number" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" autocomplete="phone" autofocus />
                                    <label class="form-label" for="phone">Phone Number</label>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <select name="gender" id="gender"
                                        class="form-select @error('gender') is-invalid @enderror" name="gender"
                                        autocomplete="gender" autofocus>
                                        <option selected hidden value="">Select Gender</option>
                                        <option disabled>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <label class="form-label" for="gender">Gender</label>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <select name="roles" id="roles"
                                        class="form-select @error('roles') is-invalid @enderror" name="roles"
                                        autocomplete="roles" autofocus>
                                        <option selected hidden value="">Select Roles</option>
                                        <option disabled>Select Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label" for="roles">Roles</label>
                                    @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" autocomplete="password" autofocus />
                                    <label class="form-label" for="password">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="password" id="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}"
                                        autocomplete="password_confirmation" autofocus />
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block text-white" style="background: #5b3523;">
                            Create user
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function previewImage() {
        const previewImg = document.getElementById('previewImg');
        previewImg.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
