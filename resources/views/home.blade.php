@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Selamat Datang di Bukit Eon</h1>
            <p class="text-lg text-gray-600 mb-8">Website sederhana dengan Tailwind CSS dan Laravel.</p>
            <a href="/login" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Login Sekarang</a>
        </div>
    </main>
    <!-- Footer -->
    @include('components.footer')
</div>
@endsection
