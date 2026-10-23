<aside class="admin-sidebar offcanvas-lg offcanvas-start bg-dark text-white p-3 border-end border-secondary" id="adminSidebar" tabindex="-1">
    <div class="offcanvas-header d-lg-none pb-3 border-bottom border-secondary mb-3">
        <h5 class="offcanvas-title heading-font fs-3 text-white">FC <span class="text-danger">LEGEND</span> ADMIN</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#adminSidebar"></button>
    </div>

    <div class="sidebar-brand mb-4 d-none d-lg-block text-center">
        <a href="/admin" class="heading-font fs-2 text-white text-decoration-none">FC <span class="text-danger">LEGEND</span></a>
        <div class="small text-muted text-uppercase tracking-wider">Control Panel</div>
    </div>

    <nav class="nav nav-pills flex-column gap-1">
        <a class="nav-link text-white {{ request()->is('admin') ? 'active bg-danger' : '' }}" href="/admin">
            <i class="fas fa-chart-line me-2"></i> Dashboard
        </a>
        <a class="nav-link text-white {{ request()->is('admin/players*') ? 'active bg-danger' : '' }}" href="/admin/players">
            <i class="fas fa-running me-2"></i> Players Management
        </a>
        <a class="nav-link text-white {{ request()->is('admin/matches*') ? 'active bg-danger' : '' }}" href="/admin/matches">
            <i class="fas fa-futbol me-2"></i> Fixture & Matches
        </a>
        <a class="nav-link text-white {{ request()->is('admin/news*') ? 'active bg-danger' : '' }}" href="/admin/news">
            <i class="fas fa-newspaper me-2"></i> News Articles
        </a>
        <a class="nav-link text-white {{ request()->is('admin/users*') ? 'active bg-danger' : '' }}" href="/admin/users">
            <i class="fas fa-user-shield me-2"></i> Admins & Staff
        </a>
        <a class="nav-link text-white {{ request()->is('admin/journalists*') ? 'active bg-danger' : '' }}" href="/admin/journalists">
            <i class="fas fa-pen-nib me-2"></i> Journalists
        </a>
    </nav>

    <hr class="border-secondary my-4">

    <div class="nav nav-pills flex-column gap-1">
        <a class="nav-link text-secondary" href="/">
            <i class="fas fa-globe me-2"></i> View Main Site
        </a>
        <a class="nav-link text-secondary" href="/profile">
            <i class="fas fa-id-badge me-2"></i> My Profile
        </a>
        <a class="nav-link text-danger mt-2" href="#" id="sidebar-logout">
            <i class="fas fa-power-off me-2"></i> Logout
        </a>
    </div>
</aside>
