@extends('layouts.app')

@section('content')
<div class="d-flex flex-column min-vh-100 bg-light">
    @include('components.navbar')
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Selamat Datang di Bukit Eon</h1>
            <p class="lead mb-4">Website sederhana dengan <b>Bootstrap</b> dan Laravel.</p>
            <a href="/login" class="btn btn-primary btn-lg">Login Sekarang</a>
        </div>
    </main>
    @include('components.footer')
</div>
@endsection
