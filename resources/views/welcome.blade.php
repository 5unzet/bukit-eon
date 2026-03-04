<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukit Eon - Welcome</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        
        <nav class="bg-[#C0C0C0] border-b border-gray-400 px-6 py-3 shadow-sm">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                
                <div class="flex items-center space-x-8">
                    <div class="bg-white p-1 rounded-full border border-black">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    
                    <div class="hidden md:flex space-x-6 text-sm font-bold uppercase tracking-wider">
                        <a href="/" class="bg-black text-white px-3 py-1 rounded">HOME</a>
                        <a href="#" class="hover:text-gray-700 py-1">PESAN TIKET</a>
                        <a href="#" class="hover:text-gray-700 py-1">LOKASI</a>
                        <a href="#" class="hover:text-gray-700 py-1">FASILITAS</a>
                        <a href="#" class="hover:text-gray-700 py-1">KONTAK</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4 text-xs font-bold uppercase">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hover:underline">DASHBOARD</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hover:underline uppercase">LOGOUT</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline">LOGIN</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:underline">REGISTER</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <main class="flex-grow flex items-center justify-center p-6">
            <div class="bg-[#BCBCBC] w-full max-w-5xl rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row items-center">
                
                <div class="flex-1 p-10 md:p-16 text-center md:text-left">
                    <h1 class="text-3xl md:text-5xl font-black mb-4 uppercase tracking-tighter">
                        HALAMAN HOME BUKIT EON
                    </h1>
                    <p class="text-xl md:text-2xl font-semibold text-gray-800 leading-relaxed">
                        Berisi semua informasi yang berkaitan dengan bukit eon
                    </p>
                </div>

                <div class="flex-1 p-6 flex justify-center">
                    <div class="bg-[#2D2D2D] p-4 rounded-xl shadow-2xl w-full max-w-sm">
                        <div class="aspect-square bg-gradient-to-br from-blue-400 to-blue-700 rounded-lg flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                            <div class="text-white transform scale-150">
                                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="text-center py-4 text-gray-500 text-xs">
            &copy; 2026 Bukit Eon Camp - All Rights Reserved
        </footer>
    </div>
</body>
</html>