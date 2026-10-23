import { api, storageUrl } from '../api.js';
import { showLoading, showEmpty, formatDate } from '../utils.js';

export function initNews() {
    loadNews();

    const searchInput = document.getElementById('news-search');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            filterNews(query);
        });
    }
}

let allNews = [];

async function loadNews() {
    const container = document.getElementById('news-grid');
    if (!container) return;

    showLoading(container, 'Loading FC Legend news articles...');

    try {
        const res = await api.news.list();
        allNews = res.news || [];

        renderNewsGrid(allNews);
    } catch (err) {
        container.innerHTML = `<div class="col-12"><div class="alert alert-danger">Error loading news (${err.message}).</div></div>`;
    }
}

function filterNews(query) {
    if (!query) {
        renderNewsGrid(allNews);
        return;
    }

    const filtered = allNews.filter(
        (item) =>
            (item.title || '').toLowerCase().includes(query) ||
            (item.content || '').toLowerCase().includes(query)
    );
    renderNewsGrid(filtered);
}

function renderNewsGrid(newsItems) {
    const container = document.getElementById('news-grid');
    if (!container) return;

    if (!newsItems.length) {
        showEmpty(container, 'No news articles match your search query.', 'fa-newspaper');
        return;
    }

    container.innerHTML = newsItems
        .map((item) => {
            const img = item.news_images && item.news_images.length > 0
                ? storageUrl(item.news_images[0].image_path)
                : 'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=800';

            return `
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card bg-dark text-white border-secondary h-100 shadow-sm news-card">
                    <img src="${img}" class="card-img-top object-fit-cover" style="height: 220px;" alt="${item.title}">
                    <div class="card-body d-flex flex-column">
                        <small class="text-danger mb-2"><i class="far fa-calendar-alt me-1"></i> ${formatDate(item.created_at)}</small>
                        <h4 class="heading-font fs-3 text-white mb-2">${item.title}</h4>
                        <p class="text-secondary small flex-grow-1">${(item.content || '').substring(0, 120)}...</p>
                        <div class="mt-3">
                            <a href="/news/${item.id}" class="btn btn-outline-danger btn-sm w-100">Read Full Story →</a>
                        </div>
                    </div>
                </div>
            </div>`;
        })
        .join('');
}
