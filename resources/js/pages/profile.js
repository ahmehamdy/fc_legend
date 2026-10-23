export function initProfile() {
    const logoutBtn = document.getElementById('profile-logout-btn');

    if (!logoutBtn) return;

    // Logout is handled by Laravel session authentication.
    // The button should submit a normal POST form.
}
