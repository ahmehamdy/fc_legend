import { login } from '../api.js';
import { showAlert, showValidationErrors } from '../utils.js';

export function initLogin() {
    const form = document.getElementById('login-form');
    const alertBox = document.getElementById('login-alert');
    const submitBtn = document.getElementById('login-submit-btn');

    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        alertBox.innerHTML = '';

        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        if (!email || !password) {
            showAlert(alertBox, 'Please enter both email and password.', 'danger');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Logging in...';

        try {
            const data = await login(email, password);
            showAlert(alertBox, 'Login successful! Redirecting...', 'success');

            const params = new URLSearchParams(window.location.search);
            const redirect = params.get('redirect');

            setTimeout(() => {
                if (redirect) {
                    window.location.href = redirect;
                } else if (data.user?.roles?.some((r) => r.name === 'admin' || r.name === 'journalist')) {
                    window.location.href = '/admin';
                } else {
                    window.location.href = '/profile';
                }
            }, 800);
        } catch (err) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i> Log In';

            if (err.errors) {
                showValidationErrors(alertBox, err.errors);
            } else {
                showAlert(alertBox, err.message || 'Invalid email or password.', 'danger');
            }
        }
    });
}
