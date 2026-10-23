import { api } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { confirmDelete, showAlert, renderPagination } from '../../utils.js';

export function initAdminJournalists() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    loadJournalistsTable(1);
}

async function loadJournalistsTable(page = 1) {
    const tbody = document.getElementById('admin-journalists-tbody');
    const pagContainer = document.getElementById('admin-journalists-pagination');
    const alertBox = document.getElementById('alert-container');

    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4"><div class="spinner-border text-danger"></div></td></tr>`;

    try {
        const res = await api.journalists.list(page);
        const journalists = res.journalists?.data || res.journalists || [];

        if (!journalists.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-4">No journalists registered.</td></tr>`;
            if (pagContainer) pagContainer.innerHTML = '';
            return;
        }

        tbody.innerHTML = journalists
            .map((j) => `
            <tr>
                <td><strong>#${j.id}</strong></td>
                <td class="fw-bold text-white">${j.name}</td>
                <td>${j.email}</td>
                <td><span class="badge bg-primary text-uppercase">Journalist</span></td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="/admin/users/${j.id}/edit" class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-outline-danger delete-journalist-btn" data-id="${j.id}" data-name="${j.name}" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>`)
            .join('');

        tbody.querySelectorAll('.delete-journalist-btn').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                if (confirmDelete(`Are you sure you want to delete journalist "${name}"?`)) {
                    try {
                        await api.journalists.delete(id);
                        showAlert(alertBox, `Journalist "${name}" deleted successfully.`, 'success');
                        loadJournalistsTable(page);
                    } catch (err) {
                        showAlert(alertBox, `Failed to delete journalist: ${err.message}`, 'danger');
                    }
                }
            });
        });

        if (pagContainer && res.journalists?.last_page) {
            renderPagination(pagContainer, res.journalists, (newPage) => loadJournalistsTable(newPage));
        }
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-danger text-center py-4">Error loading journalists (${err.message})</td></tr>`;
    }
}
