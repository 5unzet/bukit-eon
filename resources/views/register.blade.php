@extends('layouts.app')

@section('content')
<div class="d-flex flex-column min-vh-100 bg-light justify-content-center align-items-center">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <div class="d-flex justify-content-center mb-3">
            <img src="/assets/logo.png" alt="Logo" class="rounded-circle" style="height: 64px; width: 64px; object-fit: contain;">
        </div>
        <h1 class="h4 fw-bold mb-4 text-center">Daftar Akun</h1>
        <form method="POST" action="/register">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. Handphone</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email (opsional)</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
            <div class="text-center mt-3">
                <span class="text-muted">Sudah punya akun?</span>
                <a href="/login" class="text-decoration-none">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
