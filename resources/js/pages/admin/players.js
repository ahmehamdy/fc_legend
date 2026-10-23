import { api, storageUrl } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { showLoading, showEmpty, renderPagination, confirmDelete, showAlert, statusBadge } from '../../utils.js';

export function initAdminPlayers() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    loadPlayersTable(1);
}

async function loadPlayersTable(page = 1) {
    const tbody = document.getElementById('admin-players-tbody');
    const pagContainer = document.getElementById('admin-players-pagination');
    const alertBox = document.getElementById('alert-container');

    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4"><div class="spinner-border text-danger"></div></td></tr>`;

    try {
        const res = await api.players.list(page);
        const players = res.players?.data || res.players || [];

        if (!players.length) {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted py-4">No players found in database.</td></tr>`;
            if (pagContainer) pagContainer.innerHTML = '';
            return;
        }

        tbody.innerHTML = players
            .map((p) => {
                const img = storageUrl(p.image);
                return `
                <tr>
                    <td><strong>#${p.number || '-'}</strong></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="${img}" class="rounded-circle object-fit-cover" style="width: 40px; height: 40px;" alt="${p.name}">
                            <span class="fw-semibold text-white">${p.name}</span>
                        </div>
                    </td>
                    <td><span class="badge bg-secondary">${p.position}</span></td>
                    <td>${p.age} yrs</td>
                    <td>${p.nationality}</td>
                    <td>${statusBadge(p.status || 'active')}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="/admin/players/${p.id}" class="btn btn-outline-info" title="View"><i class="fas fa-eye"></i></a>
                            <a href="/admin/players/${p.id}/edit" class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-outline-danger delete-player-btn" data-id="${p.id}" data-name="${p.name}" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>`;
            })
            .join('');

        tbody.querySelectorAll('.delete-player-btn').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                if (confirmDelete(`Are you sure you want to delete player "${name}"?`)) {
                    try {
                        await api.players.delete(id);
                        showAlert(alertBox, `Player "${name}" deleted successfully.`, 'success');
                        loadPlayersTable(page);
                    } catch (err) {
                        showAlert(alertBox, `Failed to delete player: ${err.message}`, 'danger');
                    }
                }
            });
        });

        if (pagContainer && res.players?.last_page) {
            renderPagination(pagContainer, res.players, (newPage) => loadPlayersTable(newPage));
        }
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="7" class="text-danger text-center py-4">Error loading players (${err.message})</td></tr>`;
    }
}
