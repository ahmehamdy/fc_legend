<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FC Dynamo | Official Website')</title>
    @vite('resources/css/app.css')
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="/" class="logo">FC <span>DYNAMO</span></a>
            <div class="mobile-menu-btn" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="/">HOME</a></li>
                <li><a href="/about">ABOUT</a></li>
                <li><a href="/players">PLAYERS</a></li>
                <li><a href="/legends">LEGENDS</a></li>
                <li><a href="/news">NEWS</a></li>
                <li><a href="/matches">MATCHES</a></li>
                <li><a href="/contact">CONTACT</a></li>
                @auth
                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'journalist')
                        <li><a href="/admin" style="color: var(--primary);">DASHBOARD</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit"
                                style="background: none; border: none; color: #ccc; cursor: pointer;">LOGOUT</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{route('auth.login-view')}}">LOGIN</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">FC <span class="text-primary">DYNAMO</span></div>
                    <p class="text-muted mt-2">Est. 1923 • Forged in Glory</p>
                </div>
                <div>
                    <h4 class="heading-font">Quick Links</h4>
                    <ul style="list-style: none; margin-top: 1rem;">
                        <li><a href="/about" class="text-muted">Club History</a></li>
                        <li><a href="/players" class="text-muted">First Team</a></li>
                        <li><a href="/matches" class="text-muted">Fixtures</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="heading-font">Stadium</h4>
                    <p class="text-muted mt-2">Dynamo Arena<br>Capacity: 52,000</p>
                </div>
                <div>
                    <h4 class="heading-font">Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center text-muted mt-4 pt-3" style="border-top: 1px solid var(--dark-border);">
                &copy; 2025 FC Dynamo. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>

</html>
