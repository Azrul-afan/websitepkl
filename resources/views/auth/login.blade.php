{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rumah Sakit Harapan Keluarga - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1588776814546-dcd9200b070b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1650&q=80');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }

        .login-box .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.5);
        }

        .login-box h1 {
            font-weight: 700;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .form-floating i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .form-floating input {
            padding-left: 2.5rem;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .errorshake {
            border: 2px dotted red;
            animation: shake 0.4s;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <form action="{{ route('login') }}" method="POST" id="login-form">
            @csrf
            <div class="text-center mb-4">
                <img src="images/rshk-removebg-preview.png" alt="Logo RS" width="72" height="72">
                <h1>Login RSHK</h1>
            </div>

            <div class="form-floating mb-3 position-relative">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div>

            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>

            <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="remember">
                <label class="form-check-label" for="remember"> Remember me </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

            <p class="mt-5 mb-3 text-muted text-center">&copy; RSHK 2021–2025</p>
        </form>
    </div> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login RSHK</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-white font-sans min-h-screen flex items-center justify-center">

    <div class="w-full max-w-6xl flex flex-col md:flex-row rounded-lg overflow-hidden shadow-lg bg-white">

    <!-- LEFT CONTENT -->
    <div class="md:w-1/2 p-10 flex flex-col justify-center">
        <h1 class="text-4xl font-bold mb-4 text-gray-800">
            Your Health,<br><span class="text-green-500">Our Care</span>
        </h1>
        <p class="text-gray-600 mb-8">Masuk untuk mengelola data dan informasi rumah sakit Anda.</p>

        <form action="{{ route('login') }}" method="POST" id="login-form">
            @csrf
            <input type="text" name="username" placeholder="Username" id="username"
                class="w-full px-4 py-3 rounded bg-white border border-gray-300 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400">
            <input type="password" name="password" placeholder="Password" id="password"
                class="w-full px-4 py-3 rounded bg-white border border-gray-300 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-400">

            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded">
                Login
            </button>
        </form>
    </div>

    <!-- RIGHT IMAGE -->
    <div class="md:w-1/2 h-96 md:h-auto">
        <img src="/images/karakter.jpeg" alt="RSHK Hospital" class="object-cover w-full h-full">
    </div>
</div>


    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        if (response.success === 1) {
                            window.location.href = '/dashboard';
                        } else {
                            showLoginError();
                        }
                    },
                    error: function() {
                        showLoginError();
                    }
                });
            });

            function showLoginError() {
                $('.form-control').addClass('errorshake');
                setTimeout(() => $('.form-control').removeClass('errorshake'), 500);
            }
        });
    </script>
</body>

</html>
