<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard | FC Legend')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body data-page="@yield('page', 'admin-dashboard')" class="admin-body">
    <div class="admin-wrapper d-flex">
        @include('partials.sidebar')

        <div class="admin-main flex-grow-1">
            <header class="admin-topbar d-flex justify-content-between align-items-center px-4 py-3">
                <div>
                    <button class="btn btn-outline-danger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="admin-page-title heading-font mb-0 d-none d-lg-block">@yield('heading', 'Dashboard')</h1>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="/" class="btn btn-sm btn-outline-secondary"><i class="fas fa-home me-1"></i> Site</a>
                    <span class="text-muted"><i class="fas fa-user-circle me-1"></i> <span id="admin-user-name">Admin</span></span>
                </div>
            </header>

            <div class="admin-content-area p-4">
                <div id="alert-container"></div>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
