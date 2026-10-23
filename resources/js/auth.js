import { getUser, clearAuth, isAuthenticated, isAdmin, isJournalist } from './api.js';

export function initNavbar() {
    const authNav = document.getElementById('auth-nav');
    const userNameEl = document.getElementById('nav-user-name');
    const adminLink = document.getElementById('nav-admin-link');

    if (!authNav) return;

    if (isAuthenticated()) {
        const user = getUser();
        authNav.innerHTML = `
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> ${user?.name || 'Account'}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                    <li><a class="dropdown-item" href="/profile"><i class="fas fa-id-card me-2"></i>Profile</a></li>
                    ${isAdmin() || isJournalist() ? '<li><a class="dropdown-item" href="/admin"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>' : ''}
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" id="logout-btn"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </li>`;

        document.getElementById('logout-btn')?.addEventListener('click', (e) => {
            e.preventDefault();
            clearAuth();
            window.location.href = '/login';
        });
    } else {
        authNav.innerHTML = `
            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
            <li class="nav-item"><a class="nav-link btn btn-danger btn-sm ms-lg-2 px-3" href="/register">Register</a></li>`;
    }

    if (userNameEl && isAuthenticated()) {
        userNameEl.textContent = getUser()?.name || '';
    }

    if (adminLink) {
        adminLink.style.display = isAdmin() || isJournalist() ? '' : 'none';
    }
}

export function initAdminGuard() {
    if (!isAuthenticated()) {
        window.location.href = `/login?redirect=${encodeURIComponent(window.location.pathname)}`;
        return false;
    }
    if (!isAdmin() && !isJournalist()) {
        window.location.href = '/?error=forbidden';
        return false;
    }
    return true;
}

export function initAdminOnly() {
    if (!isAuthenticated()) {
        window.location.href = `/login?redirect=${encodeURIComponent(window.location.pathname)}`;
        return false;
    }
    if (!isAdmin()) {
        window.location.href = '/admin?error=forbidden';
        return false;
    }
    return true;
}

export function updateAdminUserDisplay() {
    const el = document.getElementById('admin-user-name');
    if (el && isAuthenticated()) {
        el.textContent = getUser()?.name || 'User';
    }
}
