<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@guest
            Order Coffee
        @endguest @yield('title')</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
    @include('normal-view.layout.navbar')
</head>

<body>
    @if (session('not-authorized'))
        <script>
            window.alert('You are not authorized this page!');
        </script>
    @endif
    @yield('content')

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    html {
        scroll-behavior: smooth;
    }

    body {
        height: 100vh;
        overflow-x: hidden;
    }

    .text-color {
        color: #412518;
    }

    .text-color2 {
        color: #894e32;
    }

    .text-color3 {
        color: #d09b71;
    }

    .page-link {
        background-color: #894e32 !important;
        color: white;
    }

    .page-link:hover {
        color: white;
    }

    .active>.page-link,
    .page-link.active {
        border: 1px solid #bb653c !important;
        background-color: #a97245 !important;
        color: white;
    }
</style>
