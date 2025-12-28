@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Edit Event</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label">Nama Event</label>
                            <input type="text" name="namaEvent" class="form-control" value="{{ $event->namaEvent }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Event</label>
                                <input type="date" name="tanggalEvent" class="form-control" value="{{ $event->tanggalEvent }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasiEvent" class="form-control" value="{{ $event->lokasiEvent }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsiEvent" class="form-control" rows="3" required>{{ $event->deskripsiEvent }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga Tiket (Rp)</label>
                                <input type="number" name="hargaTiket" class="form-control" value="{{ $event->hargaTiket }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok Tiket</label>
                                <input type="number" name="stokTiket" class="form-control" value="{{ $event->stokTiket }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Banner (Biarkan kosong jika tidak ingin mengubah)</label>
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                            @if($event->gambar)
                            <div class="mt-2">
                                <small class="text-muted">Gambar saat ini:</small><br>
                                <img src="/images/events/{{ $event->gambar }}" width="100px" class="rounded border">
                            </div>
                            @endif
                            @error('gambar')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
