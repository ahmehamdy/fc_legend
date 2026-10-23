import { api } from '../../api.js';
import { initAdminOnly, updateAdminUserDisplay } from '../../auth.js';
import { showAlert, showValidationErrors } from '../../utils.js';

export async function initAdminUserForm() {
    if (!initAdminOnly()) return;
    updateAdminUserDisplay();

    const form = document.getElementById('user-form');
    const alertBox = document.getElementById('user-form-alert');
    if (!form) return;

    const userId = form.dataset.userId;
    const isEdit = !!userId;

    if (isEdit) {
        loadUserData(userId);
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        alertBox.innerHTML = '';

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation')?.value;
        const role = document.getElementById('role').value;

        if (!isEdit && password !== passwordConfirmation) {
            showAlert(alertBox, 'Passwords do not match.', 'danger');
            return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        try {
            const body = { name, email, role };
            if (password) {
                body.password = password;
                if (!isEdit) body.password_confirmation = passwordConfirmation;
            }

            if (isEdit) {
                await api.admins.update(userId, body);
                showAlert(alertBox, 'User updated successfully!', 'success');
            } else {
                await api.admins.create(body);
                showAlert(alertBox, 'User account created successfully!', 'success');
            }

            setTimeout(() => {
                window.location.href = '/admin/users';
            }, 1000);
        } catch (err) {
            submitBtn.disabled = false;
            if (err.errors) {
                showValidationErrors(alertBox, err.errors);
            } else {
                showAlert(alertBox, err.message || 'Error saving user account.', 'danger');
            }
        }
    });
}

async function loadUserData(id) {
    try {
        const res = await api.admins.get(id);
        const user = res.admin;
        if (!user) return;

        document.getElementById('name').value = user.name || '';
        document.getElementById('email').value = user.email || '';
        const roleVal = user.roles && user.roles.length > 0 ? user.roles[0].name : 'admin';
        document.getElementById('role').value = roleVal;
    } catch (err) {
        console.error(err);
    }
}
