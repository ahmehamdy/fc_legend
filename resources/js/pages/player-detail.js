import { api, storageUrl } from '../api.js';
import { showLoading, statusBadge } from '../utils.js';

export async function initPlayerDetail() {
    const container = document.getElementById('player-detail-container');
    if (!container) return;

    const playerId = container.dataset.playerId;
    if (!playerId) return;

    showLoading(container, 'Loading player details...');

    try {
        const res = await api.players.get(playerId);
        const player = res.player;

        if (!player) {
            container.innerHTML = '<div class="alert alert-warning">Player not found.</div>';
            return;
        }

        const img = storageUrl(player.image);

        container.innerHTML = `
            <div class="row g-4 align-items-center">
                <div class="col-md-5 text-center">
                    <div class="position-relative d-inline-block w-100">
                        <img src="${img}" class="img-fluid rounded border border-secondary shadow-lg object-fit-cover" style="max-height: 450px; width: 100%;" alt="${player.name}">
                        <div class="position-absolute top-0 start-0 m-3 badge bg-danger fs-3">#${player.number || '-'}</div>
                        <div class="position-absolute top-0 end-0 m-3">${statusBadge(player.status || 'active')}</div>
                    </div>
                </div>
                <div class="col-md-7 text-white">
                    <span class="text-danger text-uppercase fw-bold tracking-wider">${player.position || 'Squad Member'}</span>
                    <h1 class="heading-font display-4 text-white mb-3">${player.name}</h1>

                    <div class="row g-3 my-3">
                        <div class="col-6 col-sm-4">
                            <div class="bg-dark p-3 rounded border border-secondary text-center">
                                <span class="text-secondary small d-block">Age</span>
                                <strong class="fs-4 text-white">${player.age || '-'} yrs</strong>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="bg-dark p-3 rounded border border-secondary text-center">
                                <span class="text-secondary small d-block">Nationality</span>
                                <strong class="fs-4 text-white">${player.nationality || '-'}</strong>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="bg-dark p-3 rounded border border-secondary text-center">
                                <span class="text-secondary small d-block">Height</span>
                                <strong class="fs-4 text-white">${player.height ? player.height + ' cm' : '-'}</strong>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="bg-dark p-3 rounded border border-secondary text-center">
                                <span class="text-secondary small d-block">Weight</span>
                                <strong class="fs-4 text-white">${player.weight ? player.weight + ' kg' : '-'}</strong>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="bg-dark p-3 rounded border border-secondary text-center">
                                <span class="text-secondary small d-block">Status</span>
                                <strong class="fs-4 text-white">${player.is_legend ? 'Club Legend' : 'First Team'}</strong>
                            </div>
                        </div>
                    </div>

                    <h4 class="heading-font fs-3 text-white mt-4">Biography</h4>
                    <p class="text-secondary lead fs-6">${player.bio || 'No biography available for this player yet.'}</p>

                    <a href="/players" class="btn btn-outline-danger mt-3"><i class="fas fa-arrow-left me-2"></i> Back to Squad</a>
                </div>
            </div>`;
    } catch (err) {
        container.innerHTML = `<div class="alert alert-danger">Error loading player (${err.message}).</div>`;
    }
}
