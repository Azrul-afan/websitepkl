@extends('layout.app')
@section('content')
    <!-- Tambahan CSS -->
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="profile-container">
        <!-- HEADER BANNER -->
        <div class="header-banner"></div>

        <!-- FOTO PROFIL -->
        <div class="profile-image-wrapper">
            <img src="{{ asset('images/l0m6jy5zqwxa1.png') }}" alt="Foto Profil">
        </div>

        <!-- ISI PROFIL -->
        <div class="profile-content">
            <h1 class="profile-name">Azrul Afandhil</h1>
            <p class="profile-title">Dokter Umum di RSHK</p>
            <p class="profile-location"><i class="bi bi-geo-alt-fill"></i> Nusa Tenggara Barat, Indonesia</p>

            {{-- contoh perubahan --}}
            <!-- SOSIAL MEDIA -->
            <div class="social-links">
                <a href="https://wa.me/6281529939883"><i class="bi bi-whatsapp"></i></a>
                <a href="https://instagram.com/azrulafan"><i class="bi bi-instagram"></i></a>
                <a href="https://facebook.com/username"><i class="bi bi-facebook"></i></a>
                <a href="https://tiktok.com/@afann_06"><i class="bi bi-tiktok"></i></a>
            </div>

            <!-- KONTAK -->
            <div class="contact-info">
                <p>📞 +62 815-2993-9883</p>
                <p>📧 azrul@example.com</p>
            </div>

            <!-- RATING & TOMBOL -->
            <div class="rating-chat">
                <div class="rating-stars">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                    <span class="review-count">(153 reviews)</span>
                </div>
                <a href="https://wa.me/6281529939883" class="chat-button">Chat</a>
            </div>
        </div>

        {{-- <!-- BAWAH (INTRO & KALKULATOR) -->
        <div class="bottom-box">
            <div class="calculator-box">
                <h3>Loan Calculator</h3>
                <p>Dapatkan bunga rendah dan proses cepat!</p>
                <a href="#" class="calc-button">Calculator</a>
            </div>
        </div> --}}
    </div>
    @push('script')
        <style>
            body {
                font-family: sans-serif;
                background: #fff;
                margin: 0;
                padding: 0;
            }

            .header-banner {
                background-image: url('/images/bukit.jpg');
                /* Ganti ke gambar kamu */
                background-size: cover;
                background-position: center;
                width: 100%;
                height: 350px;
                position: relative;
                z-index: 1;
            }

            .profile-container {
                position: relative;
                max-width: 1100px;
                margin: auto;
                padding: 0 20px;
            }

            .profile-image-wrapper {
                position: absolute;
                top: 260px;
                /* GANTI jadi: */
                top: 300px;
                /* atau sesuaikan ke 170–180px agar pas setengah banner */
                left: 50%;
                transform: translateX(-50%);
                border: 4px solid #fff;
                border-radius: 50%;
                overflow: hidden;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
                width: 160px;
                height: 160px;
                background: white;
                z-index: 2;
            }

            .profile-image-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .profile-content {
                margin-top: 130px;
                text-align: center;
            }

            .profile-name {
                font-size: 28px;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .profile-title {
                color: #666;
                font-size: 16px;
                margin-bottom: 5px;
            }

            .profile-location {
                color: #888;
                font-size: 14px;
                margin-bottom: 10px;
            }

            .social-links a {
                color: inherit;
                font-size: 20px;
                margin: 0 8px;
                text-decoration: none;
            }

            .contact-info {
                font-size: 14px;
                color: #555;
                margin-top: 10px;
            }

            .rating-chat {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 15px;
                margin-top: 15px;
                flex-wrap: wrap;
            }

            .rating-stars i {
                color: #facc15;
            }

            .review-count {
                font-size: 14px;
                color: #777;
                margin-left: 5px;
            }

            .chat-button {
                background-color: #14b8a6;
                color: white;
                padding: 8px 20px;
                border-radius: 9999px;
                text-decoration: none;
                font-weight: bold;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            }

            .bottom-box {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                margin-top: 40px;
                margin-bottom: 60px;
                justify-content: center;
            }

            .social-links a:hover {
                color: #14b8a6;
                /* Warna tosca atau ganti sesuai branding */
                transform: scale(1.1);
                transition: 0.3s;
            }

            .chat-button:hover {
                background-color: #0d9488;
                /* Lebih gelap dari warna tosca */
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
                transform: translateY(-2px);
                transition: 0.3s ease;
            }

            @media (max-width: 768px) {
                .profile-image-wrapper {
                    width: 120px;
                    height: 120px;
                    top: 280px;
                }

                .profile-name {
                    font-size: 22px;
                }

                .rating-chat {
                    flex-direction: column;
                    gap: 10px;
                }

                .bottom-box {
                    flex-direction: column;
                }
            }

            .header-banner::after {
                content: '';
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 80px;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.4), transparent);
                z-index: 2;
            }

            a,
            .chat-button {
                transition: all 0.3s ease-in-out;
            }
        </style>
    @endpush
@endsection
