<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <meta name="msapplication-config" content="/docs/4.6/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">



    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.6/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.6/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="images/rshk-removebg-preview.png">

    <style>
        .card {
            margin-left: auto;
            margin-right: auto;
            float: none;
        }

        .card-body::after {
            content: "";
            /* contoh icon (ganti sesuai kebutuhan) */
            font-family: 'Bootstrap Icons';
            font-size: 80px;
            color: rgba(255, 255, 255, 0.1);
            position: absolute;
            bottom: 10px;
            right: 10px;
            z-index: 0;
        }

        .dashboard-card {
            border-radius: 20px;
        }

        .card-with-image {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Biar efeknya smooth */
            will-change: transform;
            backdrop-filter: blur(5px);
            /* <- penting biar animasi jalan */
        }

        .card-with-image img.card-bg-image {
            position: absolute;
            top: 10px;
            right: 10px;
            /* Sesuaikan ukuran */
            opacity: 0.5;
            /* Biar jadi kayak bayangan */
            z-index: 0;
            pointer-events: none;
            /* Biar ga ganggu klik */
        }

        #profile {
            right: 20px;
        }

        #routeraja {
            width: 130px;
            right: 20px;
            top: 30px;
            /* ukuran gambar router */
        }

        #komputer {
            width: 210px;
            right: -20px;
            top: 30px;
            /* padding-top: 30px */
            /* ukuran gambar pc */
        }

        #printeraja {
            width: 150px;
            /* ukuran gambar printer */
        }

        .dashboard-card:hover {
            transform: translateY(-5px) scale(1.02) !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .dashboard-header {
            background: linear-gradient(to right, #003f13, #00c40a);
            /* biru gelap ke biru terang */
            padding: 20px 30px;
            border-radius: 10px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.5);
        }

        .card-with-image .card-body {
            position: relative;
            z-index: 1;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }

            .dashboard-header i {
                font-size: 30px;
                right: 10px;
                top: 5px;
            }
        }


        /* sidebar */

        .sidebar {
            background-color: white !important;
            /* Sidebar hitam */
            color: black;
            min-height: 100vh;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            overflow: hidden;
            box-shadow: 5px 0 12px rgba(6, 175, 0, 0.5);

        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            z-index: 1030;
            background: linear-gradient(to right, #000000, #00962d) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            height: 56px;
        }

        .navbar .navbar-brand {
            color: lightgreen !important;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .navbar-brand img {
            margin-right: 5px;
        }

        .navbar .nav-link {
            color: white !important;
            transition: 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: lightgreen !important;
        }


        .sidebar .nav-link {
            color: black !important;
            padding: 10px 15px;
            border-radius: 10px;
            /* biar kayak ada shape nya */
            margin: 5px 10px;
            transition: 0.3s ease;
        }


        .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #0b3f13, #18c745);
            color: white !important;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, #0b3f13, #18c745);
            /* warna shape-nya pas aktif */
            color: white !important;
            /* bisa diganti sesuai selera */
            font-weight: bold;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.6);

        }

        /* Sidebar tetap diam */
        #sidebarMenu {
            position: fixed;
            top: 56px;
            /* <- biar nggak nutupin navbar */
            bottom: 0;
            left: 0;
            width: 240px;
            background-color: #f8f9fa;
            overflow-y: auto;
            z-index: 1020;
            /* lebih rendah dari navbar */
        }

        /* Biar kontennya tidak nabrak sidebar */
        #main-content {
            margin-left: 240px;
            padding: 60px 1rem 1rem 1rem;
            /* top padding agar tidak ketiban navbar */
            min-height: 100vh;
            background-color: #fff;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.7s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        @media (max-width: 768px) {
            #sidebarMenu {
                position: relative;
                width: 100%;
                top: 0;
            }

            .navbar {
                margin-left: 0;
            }

            #main-content {
                margin-left: 0;
                padding-top: 80px;
            }

            main {
                margin-left: 0 !important;
            }
        }

        /* Sembunyikan sidebar desktop saat mobile */
        @media (max-width: 768px) {
            #sidebarMenu {
                display: none !important;
            }

            /* Sembunyikan user profile versi desktop saat mobile */
            .sidebar .user-profile {
                display: none;
            }

            /* Supaya bisa scroll saat sidebar aktif */
            body.modal-open {
                overflow: auto !important;
                padding-right: 0 !important;
            }

            /* Hilangkan blur hitam modal backdrop */
            .modal-backdrop {
                display: none;
            }
        }

        /* Sidebar Mobile Styling */
        #sidebarMenuMobile {
            background-color: white !important;
            color: black;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 5px 0 12px rgba(6, 175, 0, 0.5);
            overflow-y: auto;
            padding-bottom: 80px;
            /* biar tombol logout ga ketiban */
        }

        /* Ukuran sidebar mobile */
        @media (max-width: 768px) {
            #sidebarMenuMobile.offcanvas-start {
                width: 75%;
                max-width: 300px;
                transition: transform 0.3s ease-in-out;
            }

            .offcanvas.offcanvas-start {
                max-width: 85%;
                border-top-right-radius: 20px;
                border-bottom-right-radius: 20px;
                box-shadow: 5px 0 12px rgba(6, 175, 0, 0.5);
                overflow-y: auto;
            }
        }

        /* Link menu dalam sidebar */
        #sidebarMenuMobile .nav-link {
            color: black !important;
            padding: 10px 15px;
            border-radius: 10px;
            margin: 5px 10px;
            transition: 0.3s ease;
        }

        #sidebarMenuMobile .nav-link:hover {
            background-color: black;
            color: lightgreen !important;
        }

        #sidebarMenuMobile .nav-link.active {
            background-color: black;
            color: lightgreen !important;
            font-weight: bold;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.6);
        }

        /* Profil + logout mobile fix */
        #sidebarMenuMobile .offcanvas-body .user-profile {
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
            margin-top: 15px;
        }

        #sidebarMenuMobile .offcanvas-body .user-profile .btn {
            width: 100%;
            font-size: 0.875rem;
            padding: 6px 12px;
            border-radius: 6px;
        }

        #sidebarMenuMobile .offcanvas-body {
            position: relative;
            padding-bottom: 100px;
        }

        /* Tambahin ruang supaya konten atas gak ketiban footer */

        /* Footer profil & logout sticky di bawah */
        /* #sidebarMenuMobile .user-profile {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            background-color: white;
            border-top: 1px solid #dee2e6;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
        } */

        @media (max-width: 768px) {
            .search-mobile {
                max-width: 180px;
                /* atur sesuai kebutuhan */
                width: 100%;
                margin-left: auto;
                margin-right: auto;
                padding: 4px 10px;
                border-radius: 10px;
                font-size: 0.85rem;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand {
                flex-shrink: 0;
            }

            .navbar .btn {
                flex-shrink: 0;
            }
        }

        @media (max-width: 375px) {
            .search-mobile {
                max-width: 140px;
                width: 100%;
                font-size: 0.8rem;
                padding: 4px 8px;
                display: block !important;
            }

            .navbar-brand {
                font-size: 0.9rem;
            }

            .navbar-brand img {
                width: 30px;
                margin-right: 5px;
            }

            .navbar .btn {
                padding: 4px 8px;
            }
        }

        /* Kalau masih error di <330px, tambahin ini juga */
        @media (max-width: 330px) {
            .search-mobile {
                max-width: 120px;
                display: block !important;
            }

            .navbar-brand {
                font-size: 0.8rem;
            }

            .navbar-brand img {
                width: 28px;
            }
        }

        /* Paksa body untuk bisa di-scroll dan stylenya muncul */
        html,
        body {
            height: 100%;
            overflow-y: auto;
        }

        /* Tambah styling scrollbarnya */
        body::-webkit-scrollbar {
            width: 0px;

        }

        body::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        /* Sembunyikan scrollbar default */
        ::-webkit-scrollbar {
            width: 0px;
            height: 0px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Munculin scrollbar pas hover ke konten yang bisa discroll */
        :hover::-webkit-scrollbar {
            opacity: 1;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 4px;
        }

        .card-hover:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .dropdown-menu {
            position: absolute !important;
        }

        .sidebar-sticky {
            height: calc(100vh - 56px);
            /* tinggi layar - tinggi navbar (biasanya 56px) */
            overflow-y: auto;
        }
    </style>
</head>
