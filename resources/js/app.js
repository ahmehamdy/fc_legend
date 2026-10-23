import { initNavbar } from './auth.js';
import { initHome } from './pages/home.js';
import { initPlayers } from './pages/players.js';
import { initPlayerDetail } from './pages/player-detail.js';
import { initNews } from './pages/news.js';
import { initNewsDetail } from './pages/news-detail.js';
import { initMatches } from './pages/matches.js';
import { initMatchDetail } from './pages/match-detail.js';
import { initMatchEvents } from './pages/match-events.js';
import { initLogin } from './pages/login.js';
import { initRegister } from './pages/register.js';
import { initProfile } from './pages/profile.js';
import { initAdminDashboard } from './pages/admin/dashboard.js';
import { initAdminPlayers } from './pages/admin/players.js';
import { initAdminPlayerForm } from './pages/admin/player-form.js';
import { initAdminNews } from './pages/admin/news.js';
import { initAdminNewsForm } from './pages/admin/news-form.js';
import { initAdminMatches } from './pages/admin/matches.js';
import { initAdminMatchForm } from './pages/admin/match-form.js';
import { initAdminUsers } from './pages/admin/users.js';
import { initAdminUserForm } from './pages/admin/user-form.js';
import { initAdminJournalists } from './pages/admin/journalists.js';


const pageInitMap = {
    home: initHome,
    players: initPlayers,
    'player-detail': initPlayerDetail,
    legends: initPlayers,
    news: initNews,
    'news-detail': initNewsDetail,
    matches: initMatches,
    'match-detail': initMatchDetail,
    'match-events': initMatchEvents,
    login: initLogin,
    register: initRegister,
    profile: initProfile,
    'admin-dashboard': initAdminDashboard,
    'admin-players': initAdminPlayers,
    'admin-player-form': initAdminPlayerForm,
    'admin-news': initAdminNews,
    'admin-news-form': initAdminNewsForm,
    'admin-matches': initAdminMatches,
    'admin-match-form': initAdminMatchForm,
    'admin-users': initAdminUsers,
    'admin-user-form': initAdminUserForm,
    'admin-journalists': initAdminJournalists,
};

document.addEventListener('DOMContentLoaded', () => {
    const page = document.body.dataset.page;

    if (page && !page.startsWith('admin-')) {
        initNavbar();
    }

    if (page && pageInitMap[page]) {
        pageInitMap[page]();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const loader = document.getElementById('page-loader');

    if (!loader) return;

    setTimeout(() => {
        loader.classList.add('hidden');
    }, 300);
});
