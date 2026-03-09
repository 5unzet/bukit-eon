@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
@include('components.navdash')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">Edit Profil</div>
                <div class="card-body">
                    @if(session('swal'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire(@json(session('swal')));
                            });
                        </script>
                    @endif
                    <form method="POST" action="/dashboard/profil">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama_cust ?? $user->nama_user) }}" required>
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email_cust ?? $user->email_user) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @if(isset($user->no_hp_cust))
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp_cust) }}" required>
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @endif
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password Baru <small class="text-muted">(Opsional)</small></label>
                            <input type="password" class="form-control @error('pass') is-invalid @enderror" id="pass" name="pass" autocomplete="new-password">
                            @error('pass')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
