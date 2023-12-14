<nav class="navbar navbar-expand-lg static-top shadow-lg sticky-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="/images/icon.png" alt="COFFEE SHOP" height="80">
        </a>
        <a class="navbar-brand" href="#">
            <h3 class="text-color" style="font-family: cursive;"><strong>COFFEE SHOP</strong></h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto gap-2">
                <li class="nav-item">
                    <strong><a class="nav-link text-color" href="/"><i class="far fa-mug-hot"></i>
                            COFFEE</a></strong>
                </li>
                <li class="nav-item">
                    <strong><a class="nav-link text-color" href="/about-us"><i class="far fa-light fa-users"></i> ABOUT
                            US</a></strong>
                </li>
                <li class="nav-item">
                    <strong><a class="nav-link text-color" href="/contact-us"><i class="far fa-light fa-phone"></i>
                            CONTACT US</a></strong>
                </li>
                @role('User')
                    @auth
                        <li class="nav-item position-relative px-2"><a class="nav-link text-color"
                                href="/carts"><strong>&#8369;{{ number_format(
                                    $carts->sum(function ($cart) {
                                        return $cart->product->price * $cart->cart_quantity;
                                    }),
                                    2,
                                ) }}
                                    <i class="far fa-cart-shopping"></i>
                                    <span class="position-absolute top-0 border rounded-circle px-1"
                                        style="font-size: 12px;">{{ auth()->user()->carts()->count() }}</span></strong>
                            </a>
                        </li>
                    @endauth
                @endrole
                <li class="nav-item dropdown">
                    <a class="@guest order-coffee btn w-100 text-white @endguest" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth
                            <img class="rounded-circle"
                                src="{{ Auth::user()->profile_image === null && Auth::user()->gender === 'Male'
                                    ? url('images/boy.png')
                                    : (Auth::user()->profile_image === null && Auth::user()->gender === 'Female'
                                        ? url('images/girl.png')
                                        : Storage::url(Auth::user()->profile_image)) }}"
                                style="width: 40px; height: 40px;" alt="">
                        @else
                            <i class="far fa-mug-hot"></i> ORDER COFFEE
                        @endauth
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @auth
                            @role('Admin')
                                <li><a class="dropdown-item text-white" href="/admin/dashboard">
                                        ADMIN PAGE</a>
                                </li>
                            @endrole
                            <li><a class="dropdown-item text-white text-uppercase position-relative" href="/orders">MY
                                    ORDERS -
                                    &#8369;{{ number_format(
                                        $numOrders->sum(function ($order) {
                                            return $order->product->price * $order->order_quantity;
                                        }),
                                        2,
                                    ) }}

                                    <span class="position-absolute top-0 border rounded-circle px-1"
                                        style="font-size: 10px;">{{ auth()->user()->orders()->count() }}</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-white text-uppercase" href="#">
                                    {{ auth()->user()->lname }} {{ auth()->user()->fname }}</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-white" href="#" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    LOGOUT</a>
                            </li>
                        @else
                            <li><a class="dropdown-item text-white" href="/login">
                                    SIGN IN</a>
                            </li>
                            <li><a class="dropdown-item text-white" href="/register">
                                    SIGN UP</a>
                            </li>
                        @endauth
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    #navbar {
        background: #d09b71;
    }

    .dropdown-menu {
        background: #5b3523;
    }

    .order-coffee {
        background: #5b3523;
    }

    .order-coffee:hover {
        background: #693c28;
    }

    .dropdown-item:hover {
        background-color: #beada2;
    }
</style>
