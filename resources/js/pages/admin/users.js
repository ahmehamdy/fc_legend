import { api } from '../../api.js';
import { initAdminOnly, updateAdminUserDisplay } from '../../auth.js';
import { formatDate, confirmDelete, showAlert, renderPagination } from '../../utils.js';

export function initAdminUsers() {
    if (!initAdminOnly()) return;
    updateAdminUserDisplay();

    loadUsersTable(1);
}

async function loadUsersTable(page = 1) {
    const tbody = document.getElementById('admin-users-tbody');
    const pagContainer = document.getElementById('admin-users-pagination');
    const alertBox = document.getElementById('alert-container');

    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4"><div class="spinner-border text-danger"></div></td></tr>`;

    try {
        const res = await api.admins.list(page);
        const users = res.admins?.data || res.admins || [];

        if (!users.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-4">No users found in database.</td></tr>`;
            if (pagContainer) pagContainer.innerHTML = '';
            return;
        }

        tbody.innerHTML = users
            .map((u) => {
                const roles = u.roles?.map((r) => r.name).join(', ') || 'User';
                return `
                <tr>
                    <td><strong>#${u.id}</strong></td>
                    <td class="fw-bold text-white">${u.name}</td>
                    <td>${u.email}</td>
                    <td><span class="badge bg-danger text-uppercase">${roles}</span></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="/admin/users/${u.id}/edit" class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-outline-danger delete-user-btn" data-id="${u.id}" data-name="${u.name}" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>`;
            })
            .join('');

        tbody.querySelectorAll('.delete-user-btn').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                if (confirmDelete(`Are you sure you want to delete user "${name}"?`)) {
                    try {
                        await api.admins.delete(id);
                        showAlert(alertBox, `User "${name}" deleted successfully.`, 'success');
                        loadUsersTable(page);
                    } catch (err) {
                        showAlert(alertBox, `Failed to delete user: ${err.message}`, 'danger');
                    }
                }
            });
        });

        if (pagContainer && res.admins?.last_page) {
            renderPagination(pagContainer, res.admins, (newPage) => loadUsersTable(newPage));
        }
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-danger text-center py-4">Error loading users (${err.message})</td></tr>`;
    }
}
