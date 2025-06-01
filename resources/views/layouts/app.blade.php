<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dimsum Lindy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-brand img { height: 100px; }
        footer { background: black; color: white; padding: 20px 0; text-align: center; }
    </style>
</head>
<body>

    {{-- Header --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" style="height: 50px; margin-right: 10px;">
                DIMSUM LINDY
            </a>
        <div class="d-flex align-items-center gap-3">    
    {{-- Ikon Keranjang --}}
    @php
    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
@endphp

<div class="d-flex align-items-center gap-3">    
    {{-- Ikon Keranjang --}}
    <a href="{{ route('cart.cart') }}" class="btn btn-outline-light position-relative">
        <i class="bi bi-cart"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
            {{ $cartCount }}
        </span>
    </a>
            
                <!-- Login (Kalau belum login) -->
    @guest
    <a href="{{ route('login') }}" class="btn btn-outline-warning">
        <i class="bi bi-box-arrow-in-right"></i> Login
    </a>
    <a href="{{ route('register') }}" class="btn btn-outline-warning">
        <i class="bi bi-person-plus"></i> Register
    </a>
@endguest

@auth
    <div class="dropdown">
        <button class="btn btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
@endauth
                

        </div>
    </nav>

    {{-- Konten --}}
    <div class="container py-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer>
        <div class="bg-danger py-1"></div>
        <div>Dimsum Lindy ENAKKK</div>
    </footer>

     {{-- Tombol Download --}}
     <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">mau pesen?  download dulu yawww</a>
            <a href="{{ asset('files/menu-promo.pdf') }}" download class="btn btn-light btn-sm">
                Download APK
            </a>
            {{-- Link Sosial Media --}}
            <a href="https://www.instagram.com/dimsum__lindy123?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="text-white text-decoration-none">
                <i class="bi bi-instagram"></i> Instagram
            </a>
            <a href="https://www.facebook.com/profile.php?id=61565826266104" target="_blank" class="text-white text-decoration-none">
                <i class="bi bi-facebook"></i> Facebook
            </a>
        </div>
    </nav>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</body>
</html>
