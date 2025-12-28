@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container pb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Dashboard Overview</h2>
            <p class="text-muted">Halo Admin, inilah laporan performa event Anda hari ini.</p>
        </div>
        <div class="text-end">
            <span class="badge bg-white text-dark border px-3 py-2 rounded-pill shadow-sm">
                <i class="bi bi-calendar-check me-2 text-primary"></i> {{ date('d F Y') }}
            </span>
        </div>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-md-6 col-lg-3">
            <div class="card bg-primary text-white shadow-sm border-0 h-100 card-hover" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalManageEvents">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="bg-white bg-opacity-25 rounded p-2">
                            <i class="bi bi-calendar-event fs-4"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-uppercase small opacity-75 mb-0">Total Event</h6>
                            <h2 class="fw-bold mb-0">{{ $totalEvents }}</h2>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top border-white border-opacity-25 text-center">
                        <small class="fw-bold"><i class="bi bi-gear-fill me-1"></i> Kelola Event</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-success text-white shadow-sm border-0 h-100 card-hover" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalTiket">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="bg-white bg-opacity-25 rounded p-2">
                            <i class="bi bi-ticket-perforated fs-4"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-uppercase small opacity-75 mb-0">Tiket Terjual</h6>
                            <h2 class="fw-bold mb-0">{{ $totalTransaksi }}</h2>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top border-white border-opacity-25 text-center">
                        <small class="fw-bold"><i class="bi bi-eye me-1"></i> Lihat Pembeli</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-warning text-dark shadow-sm border-0 h-100 card-hover" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalPendapatan">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="bg-white bg-opacity-25 rounded p-2">
                            <i class="bi bi-wallet2 fs-4 text-dark"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-uppercase small opacity-75 mb-0">Pendapatan</h6>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top border-dark border-opacity-10 text-center">
                        <small class="fw-bold"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Laporan Keuangan</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card bg-info text-white shadow-sm border-0 h-100 card-hover" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalUsers">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="bg-white bg-opacity-25 rounded p-2">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <div class="text-end">
                            <h6 class="text-uppercase small opacity-75 mb-0">Total User</h6>
                            <h2 class="fw-bold mb-0">{{ $totalUsers }}</h2>
                        </div>
                    </div>
                    <div class="mt-3 pt-2 border-top border-white border-opacity-25 text-center">
                        <small class="fw-bold"><i class="bi bi-person-gear me-1"></i> Kelola User</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-bar-chart-line-fill text-primary me-2"></i> Statistik Penjualan Per Event</h6>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" style="width: 100%; height: 350px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-blue-400 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0 text-dark">Transaksi Terbaru</h6>
                    <span class="badge bg-danger animate-pulse">live</span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recents as $trx)
                        <div class="list-group-item px-4 py-3 border-0 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle text-primary fw-bold d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                        {{ strtoupper(substr($trx->user->username ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="fw-bold text-dark small">{{ Str::limit($trx->user->username ?? 'User', 10) }}</span>
                                </div>
                                <small class="text-muted" style="font-size: 0.7rem;">{{ $trx->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="ms-1 ps-4 border-start border-2">
                                <p class="mb-0 small text-muted">Beli <b>{{ $trx->jumlah_tiket }}</b> tiket</p>
                                <small class="text-primary fw-bold" style="font-size: 0.75rem;">{{ Str::limit($trx->event->namaEvent, 20) }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                            Belum ada transaksi.
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer bg-white text-center py-2">
                    <small class="text-muted">Menampilkan 5 transaksi terakhir</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('salesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            label: 'Tiket Terjual',
            data: {!! json_encode($chartData) !!},
        backgroundColor: [
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
        ],
            borderWidth: 0,
            borderRadius: 4
    }]
    },
        options: {
            responsive: true,
                maintainAspectRatio: false,
                scales: {
                y: { beginAtZero: true, grid: { borderDash: [2, 4] } },
                x: { grid: { display: false } }
            },
            plugins: {
                legend: { display: false } // Sembunyikan legenda karena sudah jelas
            }
        }
    });
    });
</script>

{{-- ModalManagementEvents --}}
<div class="modal fade" id="modalManageEvents" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable"> <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-calendar-check me-2"></i> Kelola Data Event</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-secondary fw-bold">Daftar Event Aktif</h5>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary fw-bold">
                        <i class="bi bi-plus-circle"></i> Tambah Event Baru
                    </a>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-dark">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="10%">Banner</th>
                                    <th>Nama Event</th>
                                    <th>Jadwal</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($events as $event)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($event->gambar)
                                        <img src="/images/events/{{ $event->gambar }}" width="60" class="rounded border">
                                        @else
                                        <span class="badge bg-secondary">No IMG</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ $event->namaEvent }}</td>
                                    <td>
                                        <small class="d-block text-muted">{{ date('d M Y', strtotime($event->tanggalEvent)) }}</small>
                                    </td>
                                    <td>{{ Str::limit($event->lokasiEvent, 20) }}</td>
                                    <td>Rp {{ number_format($event->hargaTiket, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($event->stokTiket > 0)
                                        <span class="badge bg-success">{{ $event->stokTiket }}</span>
                                        @else
                                        <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus event ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-emoji-frown fs-1 d-block mb-2"></i>
                                        Belum ada event. Klik tombol Tambah di atas.
                                    </td>
                                </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal rincian total pembelian tiket --}}
<div class="modal fade" id="modalTiket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-people-fill me-2"></i> Rincian Pembeli</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light">
                @foreach($events as $event)
                @if($event->transactions->count() > 0)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold d-flex justify-content-between">
                        <span>{{ $event->namaEvent }}</span>
                        <span class="badge bg-success">{{ $event->transactions->sum('jumlah_tiket') }} Tiket</span>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm table-striped mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-3">Pembeli</th>
                                <th class="text-center">Jml</th>
                                <th class="text-end pe-3">Waktu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($event->transactions as $trx)
                            <tr>
                                <td class="ps-3">{{ $trx->user->username ?? 'User Hilang' }}</td>
                                <td class="text-center">{{ $trx->jumlah_tiket }}</td>
                                <td class="text-end pe-3 small text-muted">{{ $trx->created_at->format('d/m H:i') }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                @endforeach
                @if($totalTransaksi == 0)
                <div class="text-center py-4 text-muted">Belum ada penjualan.</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Pendapatan --}}
<div class="modal fade" id="modalPendapatan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold"><i class="bi bi-cash-coin me-2"></i> Laporan Keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Nama Event</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Laku</th>
                        <th class="text-end">Pendapatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($events as $event)
                    @php $pendapatanEvent = $event->transactions->sum('total_harga'); @endphp
                    <tr>
                        <td class="fw-bold">{{ $event->namaEvent }}</td>
                        <td class="text-center">Rp {{ number_format($event->hargaTiket, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $event->transactions->sum('jumlah_tiket') }}</td>
                        <td class="text-end fw-bold {{ $pendapatanEvent > 0 ? 'text-success' : 'text-muted' }}">
                            Rp {{ number_format($pendapatanEvent, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="table-dark">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">TOTAL PEMASUKAN</td>
                        <td class="text-end fw-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal User(edit user) --}}
<div class="modal fade" id="modalUsers" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Kelola Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>User Info</th>
                        <th>Role Saat Ini</th>
                        <th>Aksi (Ganti Role)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allUsers as $u)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary rounded-circle text-white d-flex justify-content-center align-items-center me-2" style="width: 35px; height: 35px;">
                                    {{ strtoupper(substr($u->username, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $u->username }}</div>
                                    <div class="small text-muted">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                                <span class="badge {{ $u->role == 'Admin' ? 'bg-danger' : 'bg-primary' }}">
                                    {{ $u->role }}
                                </span>
                        </td>
                        <td>
                            @if($u->idUser != auth()->user()->idUser)
                            <form action="{{ route('admin.users.updateRole', $u->idUser) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PUT')
                                <select name="role" class="form-select form-select-sm" style="width: 100px;">
                                    <option value="User" {{ $u->role == 'User' ? 'selected' : '' }}>User</option>
                                    <option value="Admin" {{ $u->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Simpan Role">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                                <a href="{{ route('admin.users.delete', $u->idUser) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus user ini selamanya?')" title="Hapus User">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </form>
                            @else
                            <small class="text-muted fst-italic">Akun Anda</small>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
