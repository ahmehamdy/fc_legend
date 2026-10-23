const API_BASE = '/api';
const TOKEN_KEY = 'fc_token';
const USER_KEY = 'fc_user';

export function getToken() {
    return localStorage.getItem(TOKEN_KEY);
}

export function getUser() {
    const raw = localStorage.getItem(USER_KEY);
    if (!raw) return null;
    try {
        return JSON.parse(raw);
    } catch {
        return null;
    }
}

export function setAuth(token, user) {
    localStorage.setItem(TOKEN_KEY, token);
    localStorage.setItem(USER_KEY, JSON.stringify(user));
}

export function clearAuth() {
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem(USER_KEY);
}

export function isAuthenticated() {
    return !!getToken();
}

export function hasRole(role) {
    const user = getUser();
    if (!user?.roles) return false;
    return user.roles.some((r) => r.name === role);
}

export function isAdmin() {
    return hasRole('admin');
}

export function isJournalist() {
    return hasRole('journalist');
}

export function storageUrl(path) {
    if (!path) return '/images/player-placeholder.svg';
    if (path.startsWith('http')) return path;
    return `/storage/${path}`;
}

export class ApiError extends Error {
    constructor(message, status, errors = null) {
        super(message);
        this.status = status;
        this.errors = errors;
    }
}

export async function apiRequest(endpoint, options = {}) {
    const { method = 'GET', body = null, formData = false, auth = true } = options;

    const headers = {
        Accept: 'application/json',
    };

    if (auth && getToken()) {
        headers.Authorization = `Bearer ${getToken()}`;
    }

    const config = { method, headers };

    if (body) {
        if (formData) {
            config.body = body;
        } else {
            headers['Content-Type'] = 'application/json';
            config.body = JSON.stringify(body);
        }
    }

    const response = await fetch(`${API_BASE}${endpoint}`, config);
    let data = null;

    const contentType = response.headers.get('content-type');
    if (contentType && contentType.includes('application/json')) {
        data = await response.json();
    }

    if (response.status === 401) {
        clearAuth();
        if (!window.location.pathname.includes('/login')) {
            window.location.href = `/login?redirect=${encodeURIComponent(window.location.pathname)}`;
        }
        throw new ApiError(data?.message || 'Unauthenticated.', 401);
    }

    if (!response.ok) {
        throw new ApiError(
            data?.message || 'Something went wrong.',
            response.status,
            data?.errors || null
        );
    }

    return data;
}

export async function login(email, password) {
    const params = new URLSearchParams({ email, password });
    const response = await fetch(`${API_BASE}/login?${params}`, {
        method: 'GET',
        headers: { Accept: 'application/json' },
    });

    const data = await response.json();

    if (!response.ok) {
        throw new ApiError(data?.message || 'Invalid credentials.', response.status, data?.errors);
    }

    setAuth(data.token, data.user);
    return data;
}

export const api = {
    login,

    admins: {
        list: (page = 1) => apiRequest(`/admin?page=${page}`),
        get: (id) => apiRequest(`/admin/${id}`),
        create: (body) => apiRequest('/admin', { method: 'POST', body }),
        update: (id, body) => apiRequest(`/admin/${id}`, { method: 'PUT', body }),
        delete: (id) => apiRequest(`/admin/${id}`, { method: 'DELETE' }),
    },

    journalists: {
        list: (page = 1) => apiRequest(`/jour?page=${page}`),
        get: (id) => apiRequest(`/jour/${id}`),
        create: (body) => apiRequest('/jour', { method: 'POST', body }),
        update: (id, body) => apiRequest(`/jour/${id}`, { method: 'PUT', body }),
        delete: (id) => apiRequest(`/jour/${id}`, { method: 'DELETE' }),
    },

    players: {
        list: (page = 1) => apiRequest(`/player?page=${page}`),
        get: (id) => apiRequest(`/player/${id}`),
        create: (formData) => apiRequest('/player', { method: 'POST', body: formData, formData: true }),
        update: (id, formData) => apiRequest(`/player/${id}`, { method: 'PUT', body: formData, formData: true }),
        delete: (id) => apiRequest(`/player/${id}`, { method: 'DELETE' }),
    },

    news: {
        list: () => apiRequest('/news'),
        get: (id) => apiRequest(`/news/showNews/${id}`),
        byJournalist: (id, page = 1) => apiRequest(`/news/jourNews/${id}?page=${page}`),
        create: (formData) => apiRequest('/news', { method: 'POST', body: formData, formData: true }),
        update: (id, formData) => apiRequest(`/news/${id}`, { method: 'POST', body: formData, formData: true }),
        delete: (id) => apiRequest(`/news/${id}`, { method: 'DELETE' }),
        deleteImage: (imageId) => apiRequest(`/news/news-images/${imageId}`, { method: 'DELETE' }),
    },

    fixtures: {
        list: (page = 1) => apiRequest(`/fixture?page=${page}`),
        get: (id) => apiRequest(`/fixture/${id}`),
        create: (body) => apiRequest('/fixture', { method: 'POST', body }),
        update: (id, body) => apiRequest(`/fixture/upcomingFixture/${id}`, { method: 'PUT', body }),
        start: (id) => apiRequest(`/fixture/start/${id}`, { method: 'PUT' }),
        finish: (id) => apiRequest(`/fixture/finish/${id}`, { method: 'PUT' }),
    },

    matchEvents: {
        create: (fixtureId, body) => apiRequest(`/matchEvent/store/${fixtureId}`, { method: 'POST', body }),
    },
};
