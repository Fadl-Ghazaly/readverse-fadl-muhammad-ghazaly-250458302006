<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Readverse - Platform membaca & menulis novel digital berbasis Laravel">
    <title>Readverse</title>

    <!-- Favicons -->
    <link href="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf9 100%);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
        }

        .welcome-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            text-align: center;
            max-width: 500px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .welcome-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        h1 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        p {
            color: #7f8c8d;
            font-size: 1.05rem;
            margin-bottom: 2rem;
        }

        .btn {
            font-weight: 500;
            padding: 0.65rem 1.5rem;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .btn-primary {
            background: linear-gradient(90deg, #1e3a8a, #4f46e5);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1e40af, #4338ca);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-outline-primary {
            border-color: #4f46e5;
            color: #4f46e5;
        }

        .btn-outline-primary:hover {
            background: #f0f5ff;
            color: #4f46e5;
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(90deg, #047857, #059669);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #065f46, #047857);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .role-badge {
            display: inline-block;
            background: #e0e7ff;
            color: #4f46e5;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        @media (max-width: 576px) {
            .welcome-card {
                padding: 2rem;
            }
            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            .d-flex.justify-content-center.gap-3 > .btn {
                width: auto;
            }
        }
    </style>
</head>

<body>

    <div class="welcome-card">
        <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="Readverse" class="logo">

        <h1>Selamat Datang di Readverse</h1>

        <p>Platform membaca & menulis novel digital berbasis Laravel + Livewire.</p>

        @guest
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                    <i class="bi bi-person-plus me-1"></i> Register
                </a>
            </div>
        @else
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="btn btn-success">
                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                </a>
                <div class="role-badge">Admin</div>
            @elseif(auth()->user()->role === 'user')
                <a href="{{ route('user.homepage') }}" class="btn btn-success">
                    <i class="bi bi-house-door me-1"></i> Homepage
                </a>
                <div class="role-badge">User</div>
            @else
                <p class="text-muted">Selamat datang, {{ auth()->user()->name }}.</p>
            @endif
        @endguest
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>