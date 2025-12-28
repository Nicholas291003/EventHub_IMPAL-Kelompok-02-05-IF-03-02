<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $event->namaEvent }} - EventHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">EventHub</a>
        <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>
</nav>

<div class="container pb-5">
    <div class="alert alert-info text-center small py-1">Mode Perbaikan: Versi Baru Loaded</div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-dark d-flex align-items-center justify-content-center">
                        @if($event->gambar)
                        <img src="/images/events/{{ $event->gambar }}" class="img-fluid w-100" style="object-fit: cover; height: 100%; min-height: 400px;">
                        @else
                        <div class="text-white text-center p-5"><i class="bi bi-image fs-1"></i><p>No Image</p></div>
                        @endif
                    </div>

                    <div class="col-md-7">
                        <div class="card-body p-4 p-lg-5">
                            <div class="badge bg-warning text-dark mb-2">Event</div>
                            <h2 class="fw-bold mb-3">{{ $event->namaEvent }}</h2>
                            <p class="text-muted"><i class="bi bi-calendar me-2"></i> {{ date('d M Y', strtotime($event->tanggalEvent)) }}</p>
                            <p class="text-muted"><i class="bi bi-geo-alt me-2"></i> {{ $event->lokasiEvent }}</p>
                            <hr>
                            <p class="text-muted">{{ $event->deskripsiEvent }}</p>

                            <div class="alert alert-light border mt-4">
                                <div class="d-flex justify-content-between">
                                    <span class="h4 fw-bold text-success">Rp {{ number_format($event->hargaTiket, 0, ',', '.') }}</span>
                                    <span class="h5 fw-bold text-dark">{{ $event->stokTiket }} Tiket Sisa</span>
                                </div>
                            </div>

                            @auth
                            <div class="card bg-white border shadow-sm p-3 mt-3">
                                <h6 class="fw-bold">Pesan Tiket</h6>
                                <form action="{{ route('user.checkout', $event->id) }}" method="POST">
                                    @csrf
                                    <div class="row g-2">
                                        <div class="col-8">
                                            <input type="number" name="jumlah_tiket" class="form-control form-control-lg border-primary" value="1" min="1" max="{{ $event->stokTiket }}" style="font-weight: bold;">
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary btn-lg w-100" {{ $event->stokTiket < 1 ? 'disabled' : '' }}>
                                                Beli
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="d-grid mt-4">
                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg fw-bold text-white">
                                    LOGIN UNTUK MEMBELI
                                </a>
                            </div>
                            @endauth

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
