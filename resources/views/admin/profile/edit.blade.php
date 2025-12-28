@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-person-circle me-2"></i> Edit Profil Saya</span>

                    <a href="{{ route('welcome') }}" class="btn btn-sm btn-light text-success fw-bold shadow-sm">
                        <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                    </a>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4 align-items-center">
                            <div class="col-md-4 text-center">
                                @if($user->avatar)
                                <img src="/images/profiles/{{ $user->avatar }}" class="rounded-circle border border-3 border-success shadow-sm" width="150" height="150" style="object-fit: cover;">
                                @else
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto text-white shadow-sm" style="width: 150px; height: 150px; font-size: 3rem;">
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                </div>
                                @endif

                                <div class="mt-3">
                                    <label class="btn btn-sm btn-outline-success fw-bold">
                                        <i class="bi bi-camera"></i> Ganti Foto
                                        <input type="file" name="avatar" hidden>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h6 class="text-muted mb-3"><i class="bi bi-key"></i> Ganti Password (Opsional)</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success px-4 fw-bold">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
