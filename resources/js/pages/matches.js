import { api } from '../api.js';
import { showLoading, showEmpty, renderPagination, formatDate, statusBadge } from '../utils.js';

let currentStatusFilter = 'all';

export function initMatches() {
    loadMatches(1);

    document.querySelectorAll('[data-status-filter]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('[data-status-filter]').forEach((b) => b.classList.remove('active', 'btn-danger'));
            document.querySelectorAll('[data-status-filter]').forEach((b) => b.classList.add('btn-outline-secondary'));

            e.target.classList.remove('btn-outline-secondary');
            e.target.classList.add('active', 'btn-danger');

            currentStatusFilter = e.target.dataset.statusFilter;
            loadMatches(1);
        });
    });
}

async function loadMatches(page = 1) {
    const container = document.getElementById('matches-container');
    const pagContainer = document.getElementById('pagination-container');

    if (!container) return;

    showLoading(container, 'Loading club fixtures & results...');

    try {
        const res = await api.fixtures.list(page);
        let fixtures = res.fixture?.data || res.fixture || [];

        if (currentStatusFilter !== 'all') {
            fixtures = fixtures.filter((f) => f.status === currentStatusFilter);
        }

        if (!fixtures.length) {
            showEmpty(container, 'No fixtures match the selected filter.');
            if (pagContainer) pagContainer.innerHTML = '';
            return;
        }

        container.innerHTML = fixtures
            .map((m) => {
                const isFinished = m.status === 'finished';
                const isLive = m.status === 'live';
                const scoreText = isFinished || isLive ? `${m.home_score ?? 0} - ${m.away_score ?? 0}` : 'VS';
                const resultBadge = m.result ? `<span class="badge bg-${m.result === 'win' ? 'success' : m.result === 'loss' ? 'danger' : 'warning'} ms-2 text-uppercase">${m.result}</span>` : '';

                return `
                <div class="card bg-dark text-white border-secondary mb-3 p-3 shadow-sm">
                    <div class="row align-items-center text-center text-md-start g-3">
                        <div class="col-md-3">
                            <span class="badge bg-secondary mb-1">${m.league || 'League Match'}</span>
                            <div class="small text-secondary"><i class="far fa-calendar-alt me-1"></i> ${formatDate(m.match_date)}</div>
                        </div>
                        <div class="col-md-5 text-center">
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <h4 class="heading-font fs-3 mb-0 text-white">FC LEGEND</h4>
                                <span class="fs-2 font-monospace fw-bold text-danger px-3 py-1 bg-black rounded border border-secondary">${scoreText}</span>
                                <h4 class="heading-font fs-3 mb-0 text-white">${m.opponent}</h4>
                            </div>
                        </div>
                        <div class="col-md-4 text-center text-md-end">
                            ${statusBadge(m.status)} ${resultBadge}
                            <div class="mt-2">
                                <a href="/matches/${m.id}" class="btn btn-outline-danger btn-sm me-1">Match Details</a>
                                <a href="/matches/${m.id}/events" class="btn btn-sm btn-secondary">Live Events</a>
                            </div>
                        </div>
                    </div>
                </div>`;
            })
            .join('');

        if (pagContainer && res.fixture?.last_page) {
            renderPagination(pagContainer, res.fixture, (newPage) => loadMatches(newPage));
        }
    } catch (err) {
        container.innerHTML = `<div class="alert alert-danger">Error loading fixtures (${err.message}).</div>`;
    }
}
