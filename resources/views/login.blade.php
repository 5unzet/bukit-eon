@extends('layouts.app')

@section('content')
<div class="d-flex flex-column min-vh-100 bg-light justify-content-center align-items-center">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <div class="d-flex justify-content-center mb-3">
            <img src="/assets/logo.png" alt="Logo" class="rounded-circle" style="height: 64px; width: 64px; object-fit: contain;">
        </div>
        <h1 class="h4 fw-bold mb-4 text-center">Login Management</h1>
        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
