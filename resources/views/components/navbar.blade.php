<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img src="/assets/logo.png" alt="Logo" style="height: 40px; width: 40px; object-fit: contain; border-radius: 50%;">
            <span class="fw-bold">Bukit Eon</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/booking">Pesan Makanan</a></li>
                <li class="nav-item"><a class="nav-link" href="/ticketing">Ticketing</a></li>
                @php
                    $user = session('is_logged_in') ? session('user') : null;
                @endphp
                @if($user)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user['nama_user'] ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(($user['role_user'] ?? null) !== 'customer')
                                <li><a class="dropdown-item" href="/dashboard">Dashboard Internal</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                                @if($user && ($user['role_user'] ?? null) === 'customer')
                                    <li><a class="dropdown-item" href="/history">Riwayat Pesanan</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/profil">Profil</a></li>
                                @endif
                            <!--<li><a class="dropdown-item" href="/password">Password</a></li>
                            <li><hr class="dropdown-divider"></li>-->
                            <li><a class="dropdown-item text-danger" href="/logout">Keluar</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Daftar</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
