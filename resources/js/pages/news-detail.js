import { api, storageUrl } from '../api.js';
import { showLoading, formatDate } from '../utils.js';

export async function initNewsDetail() {
    const container = document.getElementById('news-detail-container');
    if (!container) return;

    const newsId = container.dataset.newsId;
    if (!newsId) return;

    showLoading(container, 'Loading article details...');

    try {
        const res = await api.news.get(newsId);
        const news = res.news;

        if (!news) {
            container.innerHTML = '<div class="alert alert-warning">News article not found.</div>';
            return;
        }

        const images = news.news_images || [];
        const mainImg = images.length > 0 ? storageUrl(images[0].image_path) : 'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=1200';

        const galleryHtml = images.length > 1
            ? `
            <h4 class="heading-font fs-3 text-white mt-5 mb-3"><i class="fas fa-images me-2 text-danger"></i> Photo Gallery</h4>
            <div class="row g-3">
                ${images.map((img) => `
                    <div class="col-6 col-md-4">
                        <img src="${storageUrl(img.image_path)}" class="img-fluid rounded border border-secondary object-fit-cover" style="height: 180px; width: 100%;" alt="Article image">
                    </div>`).join('')}
            </div>`
            : '';

        container.innerHTML = `
            <div class="card bg-dark text-white border-secondary p-4 p-md-5 shadow-lg">
                <div class="mb-3">
                    <span class="badge bg-danger mb-2">CLUB NEWS</span>
                    <small class="text-secondary ms-2"><i class="far fa-calendar-alt me-1"></i> ${formatDate(news.created_at)}</small>
                </div>
                <h1 class="heading-font display-4 text-white mb-4">${news.title}</h1>
                <img src="${mainImg}" class="img-fluid rounded mb-4 border border-secondary object-fit-cover w-100" style="max-height: 500px;" alt="${news.title}">

                <div class="article-content lead fs-5 text-light lh-lg">
                    ${(news.content || '').replace(/\n/g, '<br><br>')}
                </div>

                ${galleryHtml}

                <div class="border-top border-secondary mt-5 pt-4 d-flex justify-content-between align-items-center">
                    <a href="/news" class="btn btn-outline-danger"><i class="fas fa-arrow-left me-2"></i> Back to News</a>
                    <span class="text-secondary small"><i class="fas fa-user-pen me-1"></i> Journalist Article #${news.id}</span>
                </div>
            </div>`;
    } catch (err) {
        container.innerHTML = `<div class="alert alert-danger">Error loading news details (${err.message}).</div>`;
    }
}
