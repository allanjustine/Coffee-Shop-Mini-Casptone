<nav id="sidebar">
    <div class="sidebar-header d-flex align-items-center">
        <img src="/images/admin-icon.png" alt="Coffee Shop Logo" style="width: 50px; height: 50px; border-radius: 50%;">
        <h5 class="ms-3" style="color: #fff;"><strong>COFFEE SHOP</strong></h5>
    </div>


    <ul class="list-unstyled components">
        <li class="{{ 'admin/dashboard' == request()->path() ? 'active' : '' }}">
            <a href="/admin/dashboard"><i class="p-2 far fa-gauge"></i> DASHBOARD</a>
        </li>
        <li class="{{ 'admin/products' == request()->path() ? 'active' : '' }}">
            <a href="/admin/products"><i class="p-2 far fa-mug-hot"></i> COFFEE</a>
        </li>
        <li class="{{ 'admin/orders' == request()->path() ? 'active' : '' }}">
            <a href="/admin/orders"><i class="p-2 far fa-newspaper"></i> ORDERS</a>
        </li>
        <li class="{{ 'admin/users' == request()->path() ? 'active' : '' }}">
            <a href="/admin/users"><i class="p-2 far fa-users"></i> USERS</a>
        </li>
        <li class="{{ 'admin/logs' == request()->path() ? 'active' : '' }}">
            <a href="/admin/logs"><i class="p-2 far fa-history"></i> LOGS</a>
        </li>
    </ul>

    <ul class="list-unstyled CTAs">
        <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Menu</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">
                        <img class="rounded-circle"
                            src="{{ Auth::user()->profile_image === null && Auth::user()->gender === 'Male'
                                ? url('images/boy.png')
                                : (Auth::user()->profile_image === null && Auth::user()->gender === 'Female'
                                    ? url('images/girl.png')
                                    : Storage::url(Auth::user()->profile_image)) }}"
                            style="width: 40px; height: 40px;" alt="">
                        {{ auth()->user()->lname }}, {{ auth()->user()->fname }}
                    </a>
                </li>
                <li>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="far fa-arrow-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
