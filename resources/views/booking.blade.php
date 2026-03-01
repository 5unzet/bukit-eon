@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col">
    @include('components.navbar')
    <main class="flex-grow container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Pemesanan Makanan</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Menu 1 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" alt="Nasi Goreng" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Nasi Goreng</h2>
                <p class="text-gray-600 mb-2">Nasi goreng spesial dengan telur dan ayam.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 20.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 2 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80" alt="Mie Goreng" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Mie Goreng</h2>
                <p class="text-gray-600 mb-2">Mie goreng lezat dengan sayuran dan bakso.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 18.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 3 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?auto=format&fit=crop&w=400&q=80" alt="Ayam Bakar" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Ayam Bakar</h2>
                <p class="text-gray-600 mb-2">Ayam bakar bumbu khas Bukit Eon.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 25.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 4 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80" alt="Sate Ayam" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Sate Ayam</h2>
                <p class="text-gray-600 mb-2">Sate ayam dengan bumbu kacang khas.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 22.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 5 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80" alt="Bakso" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Bakso</h2>
                <p class="text-gray-600 mb-2">Bakso daging sapi dengan kuah gurih.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 15.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 6 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" alt="Soto Ayam" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Soto Ayam</h2>
                <p class="text-gray-600 mb-2">Soto ayam segar dengan koya dan telur.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 17.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 7 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1464306076886-debca5e8a6b0?auto=format&fit=crop&w=400&q=80" alt="Gado-Gado" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Gado-Gado</h2>
                <p class="text-gray-600 mb-2">Gado-gado sayur segar dengan bumbu kacang.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 16.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
            <!-- Menu 8 -->
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80" alt="Rendang" class="h-28 w-28 object-cover rounded mb-4">
                <h2 class="text-lg font-semibold mb-2">Rendang</h2>
                <p class="text-gray-600 mb-2">Rendang daging sapi khas Padang.</p>
                <span class="font-bold text-blue-600 mb-4">Rp 30.000</span>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Pesan</button>
            </div>
        </div>
    </main>
    @include('components.footer')
</div>
@endsection
