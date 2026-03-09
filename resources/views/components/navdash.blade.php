<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/dashboard">
            <img src="/assets/logo.png" alt="Logo" style="height:32px;width:32px;object-fit:contain;border-radius:50%;">
            Backend Bukit EON
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDashboard" aria-controls="navbarDashboard" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarDashboard">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Request::is('dashboard')) active bg-body-tertiary text-dark @endif" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(Request::is('dashboard/book*')) active bg-body-tertiary text-dark @endif" href="#" id="orderDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Book
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="orderDropdown">
                        <li><a class="dropdown-item" href="/dashboard/book/newTiket">Order Tiket Baru</a></li>
                        <li><a class="dropdown-item" href="/dashboard/book/newMakanan">Order Makanan Baru</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(Request::is('dashboard/tiket*') || Request::is('dashboard/order-makanan*')) active bg-body-tertiary text-dark @endif" href="#" id="orderDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Order
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="orderDropdown">
                        <li><a class="dropdown-item" href="/dashboard/tiket">Tiket Wisata</a></li>
                        <li><a class="dropdown-item" href="/dashboard/order-makanan">Order Makanan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::is('dashboard/wisata')) active bg-body-tertiary text-dark @endif" href="/dashboard/wisata">Wisata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::is('dashboard/makanan')) active bg-body-tertiary text-dark @endif" href="/dashboard/makanan">Makanan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(Request::is('dashboard/laporan*')) active bg-body-tertiary text-dark @endif" href="#" id="laporanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Laporan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="laporanDropdown">
                        <li><a class="dropdown-item" href="/dashboard/laporan/wisata">Wisata</a></li>
                        <li><a class="dropdown-item" href="/dashboard/laporan/makanan">Makanan</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <!--<img src="https://randomuser.me/api/portraits/women/70.jpg" style="height:32px" class="rounded-circle me-2" alt="Profile">-->
                        <span>{{ session('user.nama_user') }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><span class="dropdown-item-text">{{ session('user.role_user') }}</span></li>
                        <li><a class="dropdown-item text-primary" href="/">Kembali ke Website</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/logout">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
