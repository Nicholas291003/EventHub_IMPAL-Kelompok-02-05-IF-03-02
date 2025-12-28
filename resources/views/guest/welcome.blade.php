<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Platform Event Terpusat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .hero-section { background: linear-gradient(to right, #0d6efd, #0099ff); color: white; padding: 100px 0; }
        .card-event { transition: transform 0.2s; cursor: pointer; }
        .card-event:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .event-img { height: 200px; object-fit: cover; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('welcome') }}">
            <i class="bi bi-calendar-event me-2"></i> EventHub
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                @auth
                @if(Auth::user()->role == 'Admin')
                <li class="nav-item me-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-sm fw-bold shadow-sm text-dark">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard Admin
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-light btn-sm fw-bold">
                        <i class="bi bi-shield-lock me-1"></i> Profil Admin
                    </a>
                </li>
                @else
                <li class="nav-item me-2">
                    <a href="{{ route('user.tickets.index') }}" class="btn btn-outline-light btn-sm fw-bold">
                        <i class="bi bi-ticket-perforated me-1"></i> Tiket Saya
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-light btn-sm fw-bold">
                        <i class="bi bi-person-circle me-1"></i> Profil Saya
                    </a>
                </li>
                @endif  <li class="nav-item ps-2 border-start border-light">
                    <a class="btn btn-danger btn-sm fw-bold" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

                @else
                <li class="nav-item me-2">
                    <a href="{{ route('login') }}" class="nav-link text-white fw-semibold">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-light text-primary fw-bold btn-sm">Daftar Sekarang</a>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Temukan Event Seru Di Sini</h1>
        <p class="lead mb-4 opacity-75">Cari konser, seminar, atau workshop favoritmu.</p>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('welcome') }}" method="GET">
                    <div class="input-group input-group-lg shadow-sm">
                        <input type="text" name="search" class="form-control border-0" placeholder="Cari event atau lokasi..." value="{{ request('search') }}">
                        <button class="btn btn-warning fw-bold text-dark px-4" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <h3 class="fw-bold mb-4 text-secondary border-bottom pb-2">
        @if(request('search'))
        Hasil Pencarian: "{{ request('search') }}"
        @else
        Event Terbaru
        @endif
    </h3>

    <div class="row g-4">
        @forelse($events as $event)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-event">
                @if($event->gambar)
                <img src="/images/events/{{ $event->gambar }}" class="card-img-top event-img" alt="{{ $event->namaEvent }}">
                @else
                <div class="bg-light d-flex align-items-center justify-content-center event-img text-muted">
                    <i class="bi bi-image fs-1"></i>
                </div>
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-primary fw-bold"><i class="bi bi-calendar-event me-1"></i> {{ date('d M Y', strtotime($event->tanggalEvent)) }}</span>
                        <span class="text-muted"><i class="bi bi-geo-alt-fill me-1"></i> {{ Str::limit($event->lokasiEvent, 15) }}</span>
                    </div>
                    <h5 class="card-title fw-bold text-dark mb-2">{{ $event->namaEvent }}</h5>
                    <p class="card-text text-muted small mb-3">{{ Str::limit($event->deskripsiEvent, 80) }}</p>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <span class="fs-5 fw-bold text-success">Rp {{ number_format($event->hargaTiket, 0, ',', '.') }}</span>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary btn-sm stretched-link fw-bold">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="100" class="mb-3 opacity-50">
            <h4 class="text-muted">Belum ada event yang ditemukan.</h4>
            <a href="{{ route('welcome') }}" class="btn btn-primary mt-2">Reset Pencarian</a>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $events->links('pagination::bootstrap-5') }}
    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-auto">
    <div class="container">
        <small class="opacity-75">&copy; 2025 EventHub. All Rights Reserved.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
