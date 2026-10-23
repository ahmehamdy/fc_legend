export function formatDate(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
}

export function formatDateTime(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
}

export function showAlert(container, message, type = 'danger') {
    if (!container) return;
    container.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
}

export function showValidationErrors(container, errors) {
    if (!container || !errors) return;
    const list = Object.entries(errors)
        .map(([field, msgs]) => `<li><strong>${field}:</strong> ${msgs.join(', ')}</li>`)
        .join('');
    container.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">${list}</ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
}

export function showLoading(container, message = 'Loading...') {
    if (!container) return;
    container.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-danger" role="status"></div>
            <p class="text-muted mt-3">${message}</p>
        </div>`;
}

export function showEmpty(container, message = 'No data available.', icon = 'fa-inbox') {
    if (!container) return;
    container.innerHTML = `
        <div class="empty-state text-center py-5">
            <i class="fas ${icon} fa-3x text-muted mb-3"></i>
            <p class="text-muted">${message}</p>
        </div>`;
}

export function renderPagination(container, pagination, onPageChange) {
    if (!container || !pagination || pagination.last_page <= 1) {
        if (container) container.innerHTML = '';
        return;
    }

    let html = '<nav><ul class="pagination justify-content-center">';

    html += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="${pagination.current_page - 1}">Previous</a>
    </li>`;

    for (let i = 1; i <= pagination.last_page; i++) {
        html += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
            <a class="page-link" href="#" data-page="${i}">${i}</a>
        </li>`;
    }

    html += `<li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
        <a class="page-link" href="#" data-page="${pagination.current_page + 1}">Next</a>
    </li>`;

    html += '</ul></nav>';
    container.innerHTML = html;

    container.querySelectorAll('[data-page]').forEach((link) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const page = parseInt(link.dataset.page, 10);
            if (page >= 1 && page <= pagination.last_page && page !== pagination.current_page) {
                onPageChange(page);
            }
        });
    });
}

export function statusBadge(status) {
    const map = {
        active: 'success',
        injured: 'warning',
        suspended: 'danger',
        upcoming: 'secondary',
        live: 'danger',
        finished: 'success',
        win: 'success',
        loss: 'danger',
        draw: 'warning',
    };
    const cls = map[status] || 'secondary';
    return `<span class="badge bg-${cls}">${status}</span>`;
}

export function confirmDelete(message = 'Are you sure you want to delete this item?') {
    return window.confirm(message);
}

export function requireAuth(redirect = true) {
    const token = localStorage.getItem('fc_token');
    if (!token && redirect) {
        window.location.href = `/login?redirect=${encodeURIComponent(window.location.pathname)}`;
        return false;
    }
    return !!token;
}

export function getMatchEventsCache(fixtureId) {
    const key = `fc_match_events_${fixtureId}`;
    try {
        return JSON.parse(localStorage.getItem(key)) || [];
    } catch {
        return [];
    }
}

export function cacheMatchEvent(fixtureId, event) {
    const key = `fc_match_events_${fixtureId}`;
    const events = getMatchEventsCache(fixtureId);
    events.push(event);
    localStorage.setItem(key, JSON.stringify(events));
}
