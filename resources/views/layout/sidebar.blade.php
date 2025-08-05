<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Main Menu</span>
        </h6>
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
            <div class="p-3 border-top mt-auto">
                <!-- Jam -->
                <div class="d-flex align-items-center text-muted mb-2">
                    <i class="bi bi-clock me-2"></i>
                    <span id="sidebarClock" style="font-weight: 500;">--:--:--</span>
                </div>

                <!-- Tombol Contact -->
                <a href="#kontak" class="btn btn-sm btn-success w-100">
                    <i class="bi bi-telephone-forward me-1"></i> Contact
                </a>
            </div>
</nav>
</ul>
<!-- Bagian ini hanya muncul di MOBILE -->
</div>
</nav>
@push('script')
    <script>function updateClock() {
            const now = new Date();
            const jam = now.getHours().toString().padStart(2, '0');
            const menit = now.getMinutes().toString().padStart(2, '0');
            const detik = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('sidebarClock').textContent = `${jam}:${menit}:${detik}`;
        }
        setInterval(updateClock, 1000);
        updateClock(); // jalankan langsung saat pertama load</script>
@endpush
