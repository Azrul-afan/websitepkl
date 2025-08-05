@include('layout.header')
@stack('style')

<body class="{{ session('dark_mode') ? 'dark-mode' : '' }}"">
    @include('layout.navbar')


    <div class="container-fluid">
        <div class="row">
            {{-- sidebar --}}
            @include('layout.sidebar')

            {{-- main content  --}}
            <main id="main-content" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                @yield('content')



            </main>
        </div>
    </div>
</body>
@push('script')
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        }

        // Tombol desktop
        const darkToggleDesktop = document.getElementById('darkModeToggle');
        if (darkToggleDesktop) {
            darkToggleDesktop.addEventListener('click', toggleDarkMode);
        }

        // Tombol mobile
        const darkToggleMobile = document.getElementById('darkModeToggleMobile');
        if (darkToggleMobile) {
            darkToggleMobile.addEventListener('click', toggleDarkMode);
        }

        // Simpan preferensi dark mode di localStorage
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('darkMode') === 'true') {
                document.body.classList.add('dark-mode');
            }
        });
    </script>

    <style>
        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .navbar,
        .dark-mode .sidebar,
        .dark-mode .card {
            background-color: #1f1f1f;
            color: #fff;
        }

        .dark-mode a {
            color: #00ffd9;
        }

        .dark-mode .btn-outline-dark {
            border-color: #fff;
            color: #fff;
        }

        /* Mode gelap global */
        .dark-mode {
            background-color: #121212 !important;
            color: #e0e0e0 !important;
        }

        /* Navbar */
        .dark-mode .navbar {
            background-color: #1f1f1f !important;
            color: #ffffff !important;
        }

        /* Sidebar */
        .dark-mode #sidebarMenu,
        .dark-mode .sidebar-sticky,
        .dark-mode .offcanvas-body {
            background-color: #1f1f1f !important;
            color: #e0e0e0 !important;
        }

        .dark-mode .sidebar .nav-link,
        .dark-mode .sidebar .nav-link i {
            color: #e0e0e0 !important;
        }

        .dark-mode .sidebar .nav-link.active {
            background-color: #333 !important;
            color: #00ffd9 !important;
        }

        /* Main Content */
        .dark-mode main,
        .dark-mode .card,
        .dark-mode .container-fluid {
            background-color: #181818 !important;
            color: #e0e0e0 !important;
        }

        /* Tombol */
        .dark-mode .btn-outline-dark {
            border-color: #ffffff !important;
            color: #ffffff !important;
        }

        /* Link */
        .dark-mode a {
            color: black !important;
        }

        /* Table jika ada */
        .dark-mode table {
            background-color: #222 !important;
            color: #fff !important;
        }

        /* Border dan divider */
        .dark-mode hr,
        .dark-mode .border-top,
        .dark-mode .card-header {
            border-color: #444 !important;
        }

        /* .card{
                                            border: none;
                                            border-radius: 15px;
                                            box-shadow: 0 4px 15px rgba(0, 0, 0,0.3);
                                        } */
        /* === DARK MODE STYLE UNTUK NAV TABS === */
        .dark-mode .nav-tabs .nav-link {
            color: #a3e635;
            /* hijau muda */
            background-color: transparent;
            border-color: transparent;
        }

        .dark-mode .nav-tabs .nav-link.active {
            background: linear-gradient(to right, rgb(0, 53, 7), green);
            /* hijau terang */
            color: #fff;
            border-color: none;
        }

        .dark-mode .nav-tabs .nav-link:hover {
            background-color: #14532d;
            color: #bbf7d0;
        }

        .dark-mode table {
            background-color: #1e1e1e;
            /* latar tabel utama */
            color: #e4e4e4;
            border-color: #333;
        }

        .dark-mode thead {
            background-color: #2c2c2c;
            /* kepala tabel lebih gelap */
            color: #a3e635;
        }

        .dark-mode tbody tr {
            background-color: #2a2a2a;
        }

        .dark-mode tbody tr:nth-child(even) {
            background-color: #252525;
            /* baris genap beda dikit warnanya */
        }

        /* Default background (light mode) */
        .welcome-box {
            background-color: #f3f4f6;
            /* abu muda */
            padding: 20px;
            border-radius: 10px;
        }

        /* Saat dark mode */
        .dark-mode .welcome-box {
            background-color: #2e2e2e;
            /* abu gelap */
            color: #fff;
        }

        .dark-mode #sidebarClock {
            color: white;
        }

        /* Dark mode styling untuk kolom/sel (td dan th) */
        .dark-mode table.dataTable td,
        .dark-mode table.dataTable th {
            background-color: #3a3a3a !important;
            /* Abu-abu gelap terang */
            color: #fff !important;
            border-color: #555 !important;
        }

        /* Hover efek supaya lebih hidup */
        .dark-mode table.dataTable tbody tr:hover td {
            background-color: #4a4a4a !important;
        }

        .dark-mode .sidebar-heading {
            color: rgb(0, 197, 33) !important;

        }

        /* DARK MODE: Sidebar Offcanvas (Mobile) */
        .dark-mode #sidebarMenuMobile,
        .dark-mode #sidebarMenuMobile .offcanvas-body {
            background-color: #1f1f1f !important;
            color: #e0e0e0 !important;
        }

        .dark-mode #sidebarMenuMobile .nav-link,
        .dark-mode #sidebarMenuMobile .nav-link i {
            color: #e0e0e0 !important;
        }

        .dark-mode #sidebarMenuMobile .nav-link.active {
            background-color: #333 !important;
            color: #00ffd9 !important;
        }

        .dark-mode #sidebarMenuMobile .offcanvas-header {
            background-color: #2a2a2a !important;
            border-bottom: 1px solid #444;
        }

        .dark-mode #sidebarMenuMobile .btn-close {
            filter: invert(1);
        }

        .dark-mode #sidebarMenuMobile .user-profile {
            background-color: #1a1a1a !important;
            color: #e0e0e0;
            border-top: 1px solid #444;
        }

        .dark-mode #sidebarMenuMobile .user-profile strong {
            color: #00ffd9;
        }

        .dark-mode #sidebarMenuMobile .user-profile .text-muted {
            color: #bbbbbb !important;
        }

        .dark-mode #sidebarMenuMobile .btn-outline-danger {
            border-color: #ff4d4d;
            color: #ff4d4d;
        }

        .dark-mode .card-bg-image {
            box-shadow: none !important;
        }
    </style>
@endpush

{{-- footer --}}
@include('layout.footer')
