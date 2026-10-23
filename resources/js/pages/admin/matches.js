import { api } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { formatDate, statusBadge, showAlert, renderPagination } from '../../utils.js';

export function initAdminMatches() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    loadMatchesTable(1);
}

async function loadMatchesTable(page = 1) {
    const tbody = document.getElementById('admin-matches-tbody');
    const pagContainer = document.getElementById('admin-matches-pagination');
    const alertBox = document.getElementById('alert-container');

    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="7" class="text-center py-4"><div class="spinner-border text-danger"></div></td></tr>`;

    try {
        const res = await api.fixtures.list(page);
        const fixtures = res.fixture?.data || res.fixture || [];

        if (!fixtures.length) {
            tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted py-4">No fixtures scheduled.</td></tr>`;
            if (pagContainer) pagContainer.innerHTML = '';
            return;
        }

        tbody.innerHTML = fixtures
            .map((m) => {
                const isUpcoming = m.status === 'upcoming';
                const isLive = m.status === 'live';
                const isFinished = m.status === 'finished';

                const score = isUpcoming ? 'VS' : `${m.home_score ?? 0} - ${m.away_score ?? 0}`;

                let actionBtns = '';
                if (isUpcoming) {
                    actionBtns += `<button class="btn btn-sm btn-success start-match-btn me-1" data-id="${m.id}"><i class="fas fa-play me-1"></i> Start</button>`;
                    actionBtns += `<a href="/admin/matches/${m.id}/edit" class="btn btn-sm btn-outline-warning me-1"><i class="fas fa-edit"></i> Edit</a>`;
                }
                if (isLive) {
                    actionBtns += `<button class="btn btn-sm btn-danger finish-match-btn me-1" data-id="${m.id}"><i class="fas fa-flag-checkered me-1"></i> Finish</button>`;
                    actionBtns += `<a href="/matches/${m.id}/events" class="btn btn-sm btn-info me-1"><i class="fas fa-plus-circle me-1"></i> Events</a>`;
                }

                return `
                <tr>
                    <td><strong>#${m.id}</strong></td>
                    <td><span class="badge bg-secondary">${m.league || 'League'}</span></td>
                    <td class="fw-bold text-white">FC Legend vs ${m.opponent}</td>
                    <td class="font-monospace fs-5 text-danger">${score}</td>
                    <td>${formatDate(m.match_date)}</td>
                    <td>${statusBadge(m.status)}</td>
                    <td>${actionBtns}</td>
                </tr>`;
            })
            .join('');

        tbody.querySelectorAll('.start-match-btn').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                try {
                    await api.fixtures.start(id);
                    showAlert(alertBox, 'Match has been started live!', 'success');
                    loadMatchesTable(page);
                } catch (err) {
                    showAlert(alertBox, `Unable to start match: ${err.message}`, 'danger');
                }
            });
        });

        tbody.querySelectorAll('.finish-match-btn').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                try {
                    await api.fixtures.finish(id);
                    showAlert(alertBox, 'Match has been marked as finished!', 'success');
                    loadMatchesTable(page);
                } catch (err) {
                    showAlert(alertBox, `Unable to finish match: ${err.message}`, 'danger');
                }
            });
        });

        if (pagContainer && res.fixture?.last_page) {
            renderPagination(pagContainer, res.fixture, (newPage) => loadMatchesTable(newPage));
        }
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="7" class="text-danger text-center py-4">Error loading fixtures (${err.message})</td></tr>`;
    }
}
