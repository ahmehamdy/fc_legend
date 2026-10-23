@push('styles')
<style>
    .main-navbar {
        background: rgba(33, 37, 41, .92) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        transition: box-shadow .25s, padding .25s;
    }
    .main-navbar.scrolled {
        box-shadow: 0 6px 24px rgba(0, 0, 0, .45);
    }

    .main-navbar .navbar-brand { letter-spacing: 1px; }

    .main-navbar .nav-link {
        position: relative;
        font-weight: 500;
        padding: .6rem .85rem;
        color: rgba(255, 255, 255, .7);
        transition: color .2s;
    }
    .main-navbar .nav-link::after {
        content: "";
        position: absolute;
        left: .85rem; right: .85rem; bottom: .25rem;
        height: 2px;
        background: #dc3545;
        border-radius: 2px;
        transform: scaleX(0);
        transform-origin: center;
        transition: transform .25s;
    }
    .main-navbar .nav-link:hover,
    .main-navbar .nav-link.active { color: #fff; }
    .main-navbar .nav-link:hover::after,
    .main-navbar .nav-link.active::after { transform: scaleX(1); }

    @media (max-width: 991.98px) {
        .main-navbar .nav-link::after { display: none; }
        .main-navbar .nav-link.active {
            background: rgba(220, 53, 69, .15);
            border-radius: .5rem;
        }
        .main-navbar .navbar-collapse { padding: .75rem 0; }
    }

    .nav-user-btn {
        border: 1px solid rgba(255, 255, 255, .2);
        border-radius: 50rem;
        padding: .25rem .85rem .25rem .3rem;
        color: #fff;
        background: transparent;
        transition: border-color .2s, background .2s;
    }
    .nav-user-btn:hover,
    .nav-user-btn.show {
        color: #fff;
        border-color: #dc3545;
        background: rgba(220, 53, 69, .1);
    }
    .nav-avatar {
        width: 32px; height: 32px;
        background: linear-gradient(135deg, #dc3545, #a71d2a);
        font-size: .85rem; font-weight: 700;
    }

    .nav-dropdown-menu {
        min-width: 240px;
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: .85rem;
        padding: .5rem;
        box-shadow: 0 12px 32px rgba(0, 0, 0, .5);
        margin-top: .6rem !important;
    }
    .nav-dropdown-menu .dropdown-item {
        border-radius: .5rem;
        padding: .55rem .75rem;
    }
    .nav-dropdown-menu .dropdown-item:hover { background: rgba(255, 255, 255, .08); }
    .nav-dropdown-menu .dropdown-item.text-danger:hover { background: rgba(220, 53, 69, .15); }
</style>
@endpush

<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top border-bottom border-secondary main-navbar">
    <div class="container">
        <a class="navbar-brand heading-font fs-3" href="{{ url('/') }}">
            FC <span class="text-danger">LEGEND</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            @php
                $links = [
                    ['label' => 'Home',    'url' => '/',        'match' => '/'],
                    ['label' => 'About',   'url' => '/about',   'match' => 'about'],
                    ['label' => 'Players', 'url' => '/players', 'match' => 'players*'],
                    ['label' => 'Legends', 'url' => '/legends', 'match' => 'legends'],
                    ['label' => 'News',    'url' => '/news',    'match' => 'news*'],
                    ['label' => 'Matches', 'url' => '/matches', 'match' => 'matches*'],
                    ['label' => 'Contact', 'url' => '/contact', 'match' => 'contact'],
                ];
            @endphp

            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                @foreach ($links as $link)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is($link['match']) ? 'active' : '' }}"
                           href="{{ url($link['url']) }}"
                           @if (request()->is($link['match'])) aria-current="page" @endif>
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach

                @auth
                    <li class="nav-item dropdown ms-lg-3 mt-3 mt-lg-0">
                        <button class="btn nav-user-btn dropdown-toggle d-flex align-items-center gap-2"
                                type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="nav-avatar rounded-circle d-flex align-items-center justify-content-center text-white">
                                {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="small">{{ \Illuminate\Support\Str::limit(Auth::user()->name, 14) }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end nav-dropdown-menu"
                            aria-labelledby="userDropdown">
                            <li class="px-3 py-2">
                                <div class="fw-semibold text-white">{{ Auth::user()->name }}</div>
                                <small class="text-secondary d-block text-truncate">{{ Auth::user()->email }}</small>
                                <span class="badge bg-danger text-uppercase mt-2">
                                    {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user me-2 text-secondary"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('edit.profile') }}">
                                    <i class="fas fa-user-edit me-2 text-secondary"></i> Edit Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a href="{{ route('auth.login-view') }}" class="btn btn-danger rounded-pill px-4">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="navbar-spacer"></div>

@push('scripts')
<script>
    (function () {
        const nav = document.getElementById('mainNavbar');
        const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 10);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    })();
</script>
@endpush
