<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @auth {{ config('app.name', 'Laravel') }} | {{ auth()->user()->tenant->name }} @endauth @guest
    {{ config('app.name', 'Laravel') }} @endguest
</title>
<link rel="shortcut icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/main/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/main/app-dark.css') }}">
<link rel="stylesheet" href="{{ asset('css/shared/iconly.css') }}">
</head>

<body>
<div id="app">
    @include('layouts.sidebar.index')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>@yield('title')</h3>
        </div>
        <div class="page-content">
            @yield('content')
        </div>

        {{-- <footer>
            @include('layouts.footer')
        </footer> --}}
    </div>
</div>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
