<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img src="/assets/logo.png" alt="Logo" style="height: 40px; width: 40px; object-fit: contain; border-radius: 50%;">
            <span class="fw-bold">Bukit Eon</span>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/booking">Booking</a></li>
                <li class="nav-item"><a class="nav-link" href="/ticketing">Ticketing</a></li>
                @php
                    $user = session('user');
                @endphp
                @if($user)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user['nama_user'] ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/profil">Profil</a></li>
                            <li><a class="dropdown-item" href="/password">Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/logout">Keluar</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
