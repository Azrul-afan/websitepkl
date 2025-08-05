<nav class="navbar navbar-dark navbar sticky-top bg-black flex-md-nowrap p-0 shadow">
    <div class="d-flex align-items-center px-3 col-md-3 col-lg-2">
        <img src="{{ asset('images/rshk-removebg-preview.png') }}" width="40" class="me-2">
        <span class="navbar-brand mb-0 h1">RSHK</span>
        <!-- Jam Real Time -->
        {{-- <span id="clock" class="text-white me-3 d-none d-md-inline" style="font-weight: bold;"></span> --}}
    </div>

    <!-- Tombol Home & Contact (Desktop Only, No Border) -->
    {{-- <div class="d-none d-md-flex ms-4 gap-3">
        <a href="/" class="nav-link text-white">Home</a>
        <a href="https://wa.me/6281529939883" class="nav-link text-white">Contact</a>
        <a href="{{route('profile.index')}}" class="nav-link text-white">Profile</a>
    </div> --}}


    <!-- Search Form (Desktop) -->
    <form class="d-none d-md-flex ms-auto me-3" role="search" action="{{ route('search.global') }}" method="GET"
        style="max-width: 350px; width: 100%;">
        <input class="form-control bg-light border-0 text-dark rounded-pill shadow-sm" type="search"
            placeholder="Cari..." aria-label="Search" name="q">
    </form>

    <!-- Tombol Search (Mobile) -->
    <!-- Form Pencarian di Mobile -->
    <form class="d-flex d-md-none mx-auto flex-grow-1" role="search" action="" method="GET";>
        <input class="form-control form-control-sm bg-light text-dark search-mobile" type="search" name="q"
            placeholder="Cari..." aria-label="Search">
    </form>
    <!-- Sidebar toggle (Mobile Only) -->
    <div class="d-md-none ms-auto me-2 order-3">
        <button class="btn text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenuMobile">
            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
        </button>
    </div>


    <li class="nav-item d-none d-md-flex">
        <button id="darkModeToggle" class="btn btn-sm btn-outline-dark ms-2">
            <i class="bi bi-moon-fill"></i>
        </button>
    </li>

    <!-- Tombol Sign Out -->
    <ul class="navbar-nav px-3 d-none d-md-flex">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->nama }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="bi bi-person-lines-fill me-1"></i> Profil Saya
                    </a>
                </li>
                <li>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" id="logoutButton">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- Sidebar offcanvas untuk layar kecil -->
<div class="offcanvas offcanvas-start d-md-none user-profile" tabindex="-1" id="sidebarMenuMobile">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Pindahkan isi sidebar kamu di sini -->
        <ul class="nav flex-column">
            <li class="nav-item">
                {{-- <a class="nav-link active" href="/"> --}}
                <a class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}" href="/">
                    <span data-feather="home">
                        <i class="bi bi-houses-fill"></i>
                        Dashboard <span class="sr-only"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('inventaris*') ? 'active' : '' }}"
                    href="{{ route('inventaris.index') }}">
                    <i class="bi bi-backpack4"></i>
                    </svg>
                    inventaris
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('kegiatan*') ? 'active' : '' }}"
                    href="{{ route('kegiatan.index') }}">
                    <span data-feather="shopping-cart"></span>
                    <i class="bi bi-calendar-event"></i>
                    kegiatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    <i class="bi bi-flag"></i>
                    Laporan
                </a>
            </li>
            <li class="nav-item">
                <button id="darkModeToggleMobile" class="btn btn-sm btn-outline-dark ms-2">
                    <i class="bi bi-moon-fill"> Mode Gelap</i>
                </button>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Master</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                {{-- <a class="nav-link" href="/jenis"> --}}
                <a class="nav-link {{ request()->is('jenis') ? 'active' : '' }}" href="/jenis">
                    <span data-feather="file-text"></span>
                    <i class="bi bi-list-task"></i>
                    Jenis
                </a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link" href="/unit"> --}}
                <a class="nav-link {{ request()->is('unit') ? 'active' : '' }}" href="/unit">
                    <span data-feather="file-text"></span>
                    <i class="bi bi-collection"></i>
                    Unit
                </a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link" href="{{route('user.index')}}"> --}}
                <a class="nav-link {{ request()->is('user/index', 'role/index') ? 'active' : '' }}"
                    href="{{ route('user.index') }}">
                    <span data-feather="file-text"></span>
                    <i class="bi bi-person-arms-up"></i>
                    user & role
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}"
                    href="{{ route('profile.index') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    Profil Saya
                </a>
            </li>

            </li>

        </ul>
        <div class="p-3 mt-auto border-top d-md-none user-profile">
            @auth
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-4 text-success"></i>
                    <div>
                        <strong>{{ Auth::user()->nama }}</strong><br>
                        <small class="text-muted">{{ Auth::user()->role->nama ?? '-' }}</small>
                    </div>
                </div>
                <div class="mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm w-100">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</div>

@push('script')
    <script>
        document.getElementById('logoutButton').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Kamu yakin?',
                text: 'Kamu akan keluar dari sistem',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit(); // Submit the form if confirmed
                }
            });
        });
    </script>
@endpush
