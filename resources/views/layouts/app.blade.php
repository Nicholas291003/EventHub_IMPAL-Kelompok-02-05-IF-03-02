<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EventHub') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Agar footer selalu di bawah meski konten sedikit */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        main {
            flex: 1;
        }
        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
<div id="app" class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-calendar-event me-2"></i> EventHub
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="btn btn-light text-primary fw-bold btn-sm ms-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    @if(Auth::user()->role == 'Admin')
                    <li class="nav-item me-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm fw-bold text-dark shadow-sm">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-light btn-sm fw-bold">
                            <i class="bi bi-shield-lock"></i> Profil
                        </a>
                    </li>
                    @else
                    <li class="nav-item me-2">
                        <a href="{{ route('user.tickets.index') }}" class="btn btn-outline-light btn-sm fw-bold">
                            <i class="bi bi-ticket-perforated"></i> Tiket Saya
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-light btn-sm fw-bold">
                            <i class="bi bi-person-circle"></i> Profil
                        </a>
                    </li>
                    @endif

                    <li class="nav-item ps-2 border-start border-white border-opacity-25 ms-2">
                        <a class="btn btn-danger btn-sm fw-bold shadow-sm" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-0">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <h5 class="fw-bold mb-1">EventHub</h5>
            <small class="text-white-50">&copy; 2025 EventHub. Platform Tiket Terpercaya.</small>
        </div>
    </footer>

</div>
</body>
</html>
