import { api, storageUrl } from '../api.js';
import { showLoading, showEmpty, formatDate, statusBadge } from '../utils.js';

export async function initHome() {
    loadHomeNews();
    loadHomeFixtures();
    loadHomePlayers();
}

async function loadHomeNews() {
    const container = document.getElementById('home-news-container');
    if (!container) return;

    showLoading(container, 'Loading latest news...');
    try {
        const res = await api.news.list();
        const newsList = res.news || [];

        if (!newsList.length) {
            showEmpty(container, 'No news articles available.');
            return;
        }

        const items = newsList.slice(0, 3);
        container.innerHTML = items
            .map((item) => {
                const img = item.news_images && item.news_images.length > 0
                    ? storageUrl(item.news_images[0].image_path)
                    : 'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=800';

                return `
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-dark text-white border-secondary shadow-sm">
                        <img src="${img}" class="card-img-top object-fit-cover" style="height: 200px;" alt="${item.title}">
                        <div class="card-body d-flex flex-column">
                            <small class="text-danger mb-1"><i class="far fa-calendar-alt me-1"></i> ${formatDate(item.created_at)}</small>
                            <h5 class="heading-font fs-4 text-white">${item.title}</h5>
                            <p class="text-secondary small flex-grow-1">${(item.content || '').substring(0, 100)}...</p>
                            <a href="/news/${item.id}" class="btn btn-outline-danger btn-sm mt-2 align-self-start">Read Article →</a>
                        </div>
                    </div>
                </div>`;
            })
            .join('');
    } catch (err) {
        container.innerHTML = `<div class="col-12"><div class="alert alert-warning">Unable to load news right now (${err.message}).</div></div>`;
    }
}

async function loadHomeFixtures() {
    const container = document.getElementById('home-fixtures-container');
    if (!container) return;

    showLoading(container, 'Loading upcoming matches...');
    try {
        const res = await api.fixtures.list(1);
        const fixtures = res.fixture?.data || res.fixture || [];

        if (!fixtures.length) {
            showEmpty(container, 'No fixtures scheduled.');
            return;
        }

        const upcoming = fixtures.slice(0, 3);
        container.innerHTML = upcoming
            .map((m) => {
                const isFinished = m.status === 'finished';
                const scoreDisplay = isFinished ? `${m.home_score ?? 0} - ${m.away_score ?? 0}` : 'VS';
                return `
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white border-secondary text-center p-3 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-secondary">${m.league || 'League Match'}</span>
                            ${statusBadge(m.status)}
                        </div>
                        <h4 class="heading-font fs-3 my-2">FC LEGEND ${scoreDisplay} ${m.opponent}</h4>
                        <p class="text-secondary small mb-3"><i class="far fa-clock me-1"></i> ${formatDate(m.match_date)}</p>
                        <a href="/matches/${m.id}" class="btn btn-sm btn-danger w-100">Match Details</a>
                    </div>
                </div>`;
            })
            .join('');
    } catch (err) {
        container.innerHTML = `<div class="col-12"><div class="alert alert-warning">Unable to load fixtures (${err.message}).</div></div>`;
    }
}

async function loadHomePlayers() {
    const container = document.getElementById('home-players-container');
    if (!container) return;

    showLoading(container, 'Loading squad stars...');
    try {
        const res = await api.players.list(1);
        const players = res.players?.data || res.players || [];

        if (!players.length) {
            showEmpty(container, 'No squad players found.');
            return;
        }

        const featured = players.slice(0, 4);
        container.innerHTML = featured
            .map((p) => {
                const img = storageUrl(p.image);
                return `
                <div class="col-6 col-md-3 mb-4">
                    <div class="card bg-dark text-white border-secondary text-center h-100">
                        <div class="position-relative">
                            <img src="${img}" class="card-img-top object-fit-cover" style="height: 240px;" alt="${p.name}">
                            <span class="position-absolute top-0 end-0 m-2">${statusBadge(p.status || 'active')}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="heading-font fs-4 text-white mb-0">#${p.number} ${p.name}</h5>
                            <small class="text-secondary d-block mb-2">${p.position} • ${p.nationality}</small>
                            <a href="/players/${p.id}" class="btn btn-outline-danger btn-sm w-100">View Bio</a>
                        </div>
                    </div>
                </div>`;
            })
            .join('');
    } catch (err) {
        container.innerHTML = `<div class="col-12"><div class="alert alert-warning">Unable to load squad stars (${err.message}).</div></div>`;
    }
}
