@extends('layouts.app')

@section('content')
<div class="d-flex flex-column min-vh-100 bg-light justify-content-center align-items-center">
    <div class="w-100" style="max-width: 400px;">
        <a href="{{ url('/') }}" class="btn btn-outline-primary mb-3">
            &larr; Kembali ke Beranda
        </a>
    </div>
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <div class="d-flex justify-content-center mb-3">
            <img src="/assets/logo.png" alt="Logo" class="rounded-circle" style="height: 64px; width: 64px; object-fit: contain;">
        </div>
        <h1 class="h4 fw-bold mb-4 text-center">Masuk Pengguna</h1>
        <form method="POST" action="/login">
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
                <label for="username" class="form-label">Email/No. Handphone</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="text-center mt-3">
                <span class="text-muted">Belum punya akun?</span>
                <a href="/register" class="text-decoration-none">Daftar</a>
            </div>
        </form>
    </div>
</div>
@endsection
