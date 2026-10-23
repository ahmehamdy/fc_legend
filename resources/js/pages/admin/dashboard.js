import { api } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';

export async function initAdminDashboard() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    loadDashboardCounts();
}

async function loadDashboardCounts() {
    try {
        const [pRes, fRes, nRes, aRes] = await Promise.all([
            api.players.list(1).catch(() => ({ players: [] })),
            api.fixtures.list(1).catch(() => ({ fixture: [] })),
            api.news.list().catch(() => ({ news: [] })),
            api.admins.list(1).catch(() => ({ admins: [] })),
        ]);

        const playerCount = pRes.players?.total || (pRes.players?.data || pRes.players || []).length;
        const fixtureCount = fRes.fixture?.total || (fRes.fixture?.data || fRes.fixture || []).length;
        const newsCount = (nRes.news || []).length;
        const adminCount = aRes.admins?.total || (aRes.admins?.data || aRes.admins || []).length;

        document.getElementById('stat-players-count')?.replaceChildren(document.createTextNode(playerCount));
        document.getElementById('stat-fixtures-count')?.replaceChildren(document.createTextNode(fixtureCount));
        document.getElementById('stat-news-count')?.replaceChildren(document.createTextNode(newsCount));
        document.getElementById('stat-admins-count')?.replaceChildren(document.createTextNode(adminCount));
    } catch {
        // Fallback silently if partial errors
    }
}
