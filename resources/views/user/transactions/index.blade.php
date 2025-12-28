@extends('layouts.app')

@section('content')
<div style="
    background: linear-gradient(to bottom right, rgba(13, 110, 253, 0.9), rgba(102, 16, 242, 0.8)),
                url('https://images.unsplash.com/photo-1429962714451-bb934ecdc4ec?q=80&w=1920&auto=format&fit=crop');
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Efek parallax saat di-scroll */
    min-height: 90vh; /* Memastikan background memenuhi layar */
    padding-top: 3rem;
    padding-bottom: 3rem;
">
    <div class="container">
        <h2 class="fw-bold mb-4 text-white">
            <i class="bi bi-ticket-perforated me-2"></i> Tiket Saya
        </h2>

        <div class="row g-4">
            @forelse($tickets as $ticket)
            <div class="col-md-6 col-lg-4">
                <div class="card mb-3 border-0 shadow-lg h-100" style="background: rgba(255, 255, 255, 0.95); transition: transform 0.3s; cursor: default;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="row g-0 align-items-center h-100">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary mb-1">{{ $ticket->event->namaEvent }}</h5>
                                <p class="card-text text-muted small mb-2">
                                    <i class="bi bi-calendar-event me-1"></i> {{ date('d M Y', strtotime($ticket->event->tanggalEvent)) }}<br>
                                    <i class="bi bi-geo-alt me-1"></i> {{ Str::limit($ticket->event->lokasiEvent, 30) }}
                                </p>
                                <div class="d-flex align-items-center mt-3">
                                    <span class="badge bg-secondary me-2" style="font-family: monospace; letter-spacing: 1px;">
                                        {{ strtoupper(substr(md5($ticket->id . $ticket->created_at), 0, 8)) }}
                                    </span>
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-check-circle-fill me-1"></i> {{ $ticket->jumlah_tiket }} 1 Orang
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center p-3 bg-light h-100 d-flex flex-column justify-content-center border-start">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $ticket->id }}-{{ $ticket->event->id }}" alt="QR Code" class="img-fluid rounded border p-1 bg-white shadow-sm mb-2" style="max-width: 100px;">
                            <small class="text-muted" style="font-size: 0.7rem;">Scan di Lokasi</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm" style="background: rgba(255, 255, 255, 0.9); border: none;">
                    <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
                    <h5 class="fw-bold">Belum ada tiket.</h5>
                    <p>Anda belum membeli tiket event apapun. Yuk cari event seru!</p>
                    <a href="{{ route('welcome') }}" class="btn btn-primary fw-bold mt-2">Cari Event Sekarang</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
