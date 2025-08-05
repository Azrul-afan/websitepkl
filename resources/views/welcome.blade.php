@extends('layout.app')
@section('content')
    <div class="dashboard-header mb-3">
        <h1 class="h4 mb-0 bi bi-cpu" style="text-align: center"> Dashboard</h1>
    </div>


    <!-- Card Header -->
    <div class="card-header bg-success text-white text-center"
        style="background: linear-gradient(to right, rgb(0, 77, 19),rgb(0, 190, 48));">
        <h4 class="mb-0">Selamat Datang</h4>
    </div>

    <!-- ROW UTAMA: Cuaca - Selamat Datang - Foto -->
    <!-- CARD UCAPAN SELAMAT DATANG -->
    <div class="card mb-4 shadow-lg border-0 dashboard-wrapper"
        style="background: linear-gradient(to right, #d9f9e3, #ffffff); border-radius: 20px; overflow: hidden; position: relative;">
        <div class="row g-0 align-items-center">
            <!-- Cuaca -->
            <div class="col-md-3 text-center p-3">
                <h5 class="fw-bold text-success">Cuaca Hari Ini</h5>
                <i class="bi bi-cloud-sun-fill" style="font-size: 50px; color: orange;"></i>
                <p class="mt-2 mb-0">Cerah Berawan</p>
                <small>28°C | Kelembapan 70%</small>
            </div>

            <!-- Ucapan Selamat Datang -->
            <div class="col-md-6 text-center p-4">
                <h2 class="fw-bold" style="color: #006b2d; text-shadow: 1px 1px 2px #a8a8a8;">
                    Selamat Datang di Website RSHK
                </h2>
                <p class="lead text-muted">Pantau aset teknologi Anda dengan mudah dan cepat.</p>
            </div>

            <!-- Foto Gedung -->
            <div class="col-md-3 p-3 text-center">
                <img src="{{ asset('images/RUMAH-SAKIT-HARAPAN-KELUARGA-MATARAM-MEDICASTORE.jpg') }}" alt="Foto RSHK"
                    class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                <p class="mt-2 mb-0 text-muted">Rumah Sakit Harapan Keluarga</p>
            </div>
        </div>

        <!-- ROW PROFILE & STATISTIK -->
        <div class="row mb-4">
            <!-- Profil Pengguna -->
            <div class="col-md-4 mb-3">
                <div class="card text-white shadow h-100" style="background: #2c2c2c; border-radius: 12px;">
                    <div class="card-body">
                        <h5 class="card-title text-warning mb-3"><i class="bi bi-person-circle me-2"></i> Profil
                            Pengguna</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('images/l0m6jy5zqwxa1.png') }}" alt="Foto Profil" class="rounded-circle me-3"
                                style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1">{{ Auth::user()->nama ?? '-' }}</h6>
                                <p class="mb-0 text-white-50">{{ Auth::user()->role->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <p class="mb-0"><strong class="text-warning">Level:</strong> Admin/User</p>
                    </div>
                </div>
            </div>

            <!-- Statistik User -->
            <div class="col-md-8 mb-3">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-3">Statistik User</h5>
                        <canvas id="userChart" height="100"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <!-- KARTU KOMPUTER -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card text-white shadow fade-in card-with-image dashboard-card"
                        style="animation-delay: 0.2s; width: 18rem; background: linear-gradient(to right, darkblue,rgb(140, 140, 253));">
                        <img src="{{ asset('images/komputer.png') }}" alt="bg icon" class="card-bg-image" id="komputer">
                        <div class="card-body">
                            <h5 class="card-title">Komputer</h5>
                            <h6 class="card-subtitle mb-2 text-white-50">Jumlah Komputer yang Ada</h6>
                            <p class="card-text" style="font-size: 40px; font-weight: bold;">
                                30 <i class="bi bi-pc-display"></i>
                            </p>
                            <a href="#" class="btn btn-outline-light w-100 rounded-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>

                <!-- KARTU PRINTER -->
                <div class="col-md-4 mb-3">
                    <div class="card text-white shadow fade-in card-with-image dashboard-card"
                        style="animation-delay: 0.3s; width: 18rem; background: linear-gradient(to right, rgb(224, 123, 0),rgb(255, 211, 130));">
                        <img src="{{ asset('images/printer.png') }}" alt="bg icon" class="card-bg-image" id="printeraja">
                        <div class="card-body">
                            <h5 class="card-title">Printer</h5>
                            <h6 class="card-subtitle mb-2 text-white-50">Jumlah Printer yang Ada</h6>
                            <p class="card-text" style="font-size: 40px; font-weight: bold;">
                                15 <i class="bi bi-printer-fill"></i>
                            </p>
                            <a href="#" class="btn btn-outline-light w-100 rounded-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>

                <!-- KARTU ALAT JARINGAN -->
                <div class="col-md-4 mb-3">
                    <div class="card text-white shadow fade-in card-with-image dashboard-card"
                        style="animation-delay: 0.4s; width: 18rem; background: linear-gradient(to right, darkred,rgb(255, 121, 121));">
                        <img src="{{ asset('images/router.png') }}" alt="bg icon" class="card-bg-image" id="routeraja">
                        <div class="card-body">
                            <h5 class="card-title">Alat Jaringan</h5>
                            <h6 class="card-subtitle mb-2 text-white-50">Jumlah Alat Jaringan yang Ada</h6>
                            <p class="card-text" style="font-size: 40px; font-weight: bold;">
                                20 <i class="bi bi-tools"></i>
                            </p>
                            <a href="#" class="btn btn-outline-light w-100 rounded-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card text-white shadow fade-in dashboard-card"
                        style="animation-delay: 0.5s; width: 18rem; background: linear-gradient(rgb(73, 0, 73),purple);">
                        <div class="card-body">
                            <h5 class="card-title">User</h5>
                            <h6 class="card-subtitle mb-2 text-white-50">Jumlah User yang ada</h6>
                            <p class="card-text" style="font-size: 40px; font-weight: bold;">
                                {{ $user->count() }} <i class="bi bi-person-fill"></i>
                            </p>
                            <a href="#" class="btn btn-outline-light w-100 rounded-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white shadow fade-in dashboard-card"
                        style="animation-delay: 0.6s; width: 18rem; background: linear-gradient(darkgreen,rgb(0, 167, 0));">
                        <div class="card-body">
                            <h5 class="card-title">User Aktif</h5>
                            <h6 class="card-subtitle mb-2 text-white-50">Jumlah User yang ada</h6>
                            <p class="card-text" style="font-size: 40px; font-weight: bold;">
                                {{ $useraktif->count() }} <i class="bi bi-person-fill-check"></i>
                            </p>
                            <a href="#" class="btn btn-outline-light w-100 rounded-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white shadow fade-in dashboard-card"
                        style="animation-delay: 0.7s; width: 18rem; background: linear-gradient(rgb(66, 66, 66),rgb(141, 141, 141));">
                        <div class="card-body">
                            <h5 class="card-title">User Tidak Aktif</h5>
                            <h6 class="card-subtitle mb-2 text-white-50">Jumlah User yang ada</h6>
                            <p class="card-text" style="font-size: 40px; font-weight: bold;">
                                {{ $usertidakaktif->count() }} <i class="bi bi-person-fill-dash"></i>
                            </p>
                            <a href="#" class="btn btn-outline-light w-100 rounded-3 fw-semibold">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            /* #dashboard-area {
                                                                                                                background-color: #ffffff;
                                                                                                                background-image: radial-gradient(circle, #dcdcdc 1px, transparent 1px);
                                                                                                                background-size: 40px 40px;
                                                                                                                background-repeat: repeat;
                                                                                                                min-height: 100vh;
                                                                                                                padding-top: 30px;
                                                                                                            } */
        </style>


        @push('script')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctx = document.getElementById('userChart').getContext('2d');
                const userChart = new Chart(ctx, {
                    type: 'bar', // bisa diganti jadi 'bar', 'area', dll
                    data: {
                        labels: ['Total', 'Aktif', 'Tidak Aktif'],
                        datasets: [{
                            label: 'Jumlah User',
                            data: [{{ $user->count() }}, {{ $useraktif->count() }},
                                {{ $usertidakaktif->count() }}
                            ],
                            fill: true,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            pointBackgroundColor: '#fff',
                            pointRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });

                function updateClock() {
                    const now = new Date();
                    let hours = now.getHours().toString().padStart(2, '0');
                    let minutes = now.getMinutes().toString().padStart(2, '0');
                    let seconds = now.getSeconds().toString().padStart(2, '0');
                    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
                }

                setInterval(updateClock, 1000); // Update setiap detik
                updateClock(); // Panggil langsung pertama kali
            </script>
            <style>
                /* DARK MODE untuk kotak ucapan selamat datang */
                .dark-mode .dashboard-wrapper {
                    background: #2b2b2b !important;
                    /* Abu gelap */
                    color: #f1f1f1 !important;
                }

                /* Biar teks dan ikon juga menyesuaikan */
                .dark-mode .dashboard-wrapper h2,
                .dark-mode .dashboard-wrapper h5,
                .dark-mode .dashboard-wrapper p,
                .dark-mode .dashboard-wrapper small {
                    color: #f1f1f1 !important;
                }

                /* Cuaca icon warnanya bisa tetap cerah */
                .dark-mode .dashboard-wrapper .bi-cloud-sun-fill {
                    color: #ffa500 !important;
                }

                /* Gambar rumah sakit tetap normal, tapi teks bawahnya diatur */
                .dark-mode .dashboard-wrapper img {
                    box-shadow: 0 0 5px #555;
                }

                .dark-mode .dashboard-wrapper .text-muted {
                    color: #ccc !important;
                }
            </style>
        </div>
    @endpush
@endsection
