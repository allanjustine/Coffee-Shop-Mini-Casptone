@extends('normal-view.layout.base')

@section('title')
    | Contact Us
@endsection

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="col-md-7">
                <h1 class="text-color">
                    <strong>Contact Us</strong>
                </h1>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="form-group mb-3">
                                    <input type="text" value="{{ old('name') }}"
                                        class="form-control p-3 @error('name') is-invalid @enderror" name="name"
                                        placeholder="Your name">
                                    @error('name')
                                        <span><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" value="{{ old('email') }}"
                                        class="form-control p-3 @error('email') is-invalid @enderror" name="email"
                                        placeholder="Your email">
                                    @error('email')
                                        <span><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="" cols="30"
                                        rows="5" placeholder="Your message">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span><strong class="text-danger">{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                @if (session('message'))
                                    <div class="alert alert-success alert-dismissible fade show text-center mt-5"
                                        role="alert">
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>

                            <button class="btn text-white py-3 px-5" type="submit"
                                style="background: #382015;"><strong>Send
                                    Message</strong></button>
                        </form>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <span class="text-black"><strong>EMAIL</strong></span>
                        <p class="text-color">coffeeshop@gmail.com</p>
                        <span class="text-black"><strong>PHONE</strong></span>
                        <p class="text-color">0909213421342 - SMART & 0912312414 - GLOBE</p>
                        <span class="text-black"><strong>ADDRESS</strong></span>
                        <p class="text-color">Skena Japan, Bohol Manila Cebu St. City, Philippines</p>
                        <span class="text-black"><strong>SOCIALS</strong></span>
                        <p class="text-color"><i class="fab fa-facebook"></i> <i class="fab fa-instagram"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
