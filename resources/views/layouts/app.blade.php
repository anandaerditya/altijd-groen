<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    <title>{{ $page_title }} - Altijd Groen</title>
</head>
<body>
@if(request()->is('admin*'))
    <nav class="navbar navbar-expand-md bg-dark py-3" data-bs-theme="dark">
        <div class="container-fluid mx-3">
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link @if(request()->is('admin')) active @endif " href="{{ route('admin.home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
@endif
@yield('page.contents')

<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/script.min.js') }}"></script>
@stack('page.scripts')
</body>
</html>
