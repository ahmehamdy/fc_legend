import { api, storageUrl } from '../api.js';
import { showLoading, showEmpty, renderPagination, statusBadge } from '../utils.js';

let currentPage = 1;
let currentPositionFilter = 'all';
let currentSearch = '';

export function initPlayers() {
    loadPlayers(1);

    const posFilter = document.getElementById('position-filter');
    const searchInput = document.getElementById('player-search');

    if (posFilter) {
        posFilter.addEventListener('change', (e) => {
            currentPositionFilter = e.target.value;
            loadPlayers(1);
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            currentSearch = e.target.value.toLowerCase().trim();
            loadPlayers(1);
        });
    }
}

async function loadPlayers(page = 1) {
    currentPage = page;
    const container = document.getElementById('players-grid');
    const pagContainer = document.getElementById('pagination-container');

    if (!container) return;

    showLoading(container, 'Loading FC Legend Squad...');

    try {
        const res = await api.players.list(page);
        let players = res.players?.data || res.players || [];
        const isLegendsPage = document.body.dataset.page === 'legends';

        if (isLegendsPage) {
            players = players.filter((p) => p.is_legend == 1);
        }

        if (currentPositionFilter !== 'all') {
            players = players.filter((p) => (p.position || '').toLowerCase() === currentPositionFilter.toLowerCase());
        }

        if (currentSearch) {
            players = players.filter((p) =>
                (p.name || '').toLowerCase().includes(currentSearch) ||
                (p.nationality || '').toLowerCase().includes(currentSearch) ||
                (p.number || '').toString().includes(currentSearch)
            );
        }

        if (!players.length) {
            showEmpty(container, 'No squad players found matching your criteria.');
            if (pagContainer) pagContainer.innerHTML = '';
            return;
        }

        container.innerHTML = players
            .map((p) => {
                const img = storageUrl(p.image);
                return `
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card bg-dark text-white border-secondary h-100 player-card shadow-sm">
                        <div class="position-relative overflow-hidden">
                            <img src="${img}" class="card-img-top object-fit-cover" style="height: 260px;" alt="${p.name}">
                            <span class="position-absolute top-0 end-0 m-2">${statusBadge(p.status || 'active')}</span>
                            <span class="position-absolute bottom-0 start-0 m-2 badge bg-danger fs-6">#${p.number || '-'}</span>
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="heading-font fs-3 text-white mb-1">${p.name}</h5>
                            <p class="text-secondary small mb-2">${p.position || 'Player'} • ${p.nationality || 'FC Legend'}</p>
                            <div class="mt-auto">
                                <a href="/players/${p.id}" class="btn btn-outline-danger btn-sm w-100">View Full Profile</a>
                            </div>
                        </div>
                    </div>
                </div>`;
            })
            .join('');

        if (pagContainer && res.players?.last_page) {
            renderPagination(pagContainer, res.players, (newPage) => loadPlayers(newPage));
        }
    } catch (err) {
        container.innerHTML = `<div class="col-12"><div class="alert alert-danger">Error loading squad data (${err.message}).</div></div>`;
    }
}
