import { api, storageUrl } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { formatDate, confirmDelete, showAlert } from '../../utils.js';

export function initAdminNews() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    loadNewsTable();
}

async function loadNewsTable() {
    const tbody = document.getElementById('admin-news-tbody');
    const alertBox = document.getElementById('alert-container');

    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4"><div class="spinner-border text-danger"></div></td></tr>`;

    try {
        const res = await api.news.list();
        const newsList = res.news || [];

        if (!newsList.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted py-4">No news articles found.</td></tr>`;
            return;
        }

        tbody.innerHTML = newsList
            .map((item) => {
                const img = item.news_images && item.news_images.length > 0
                    ? storageUrl(item.news_images[0].image_path)
                    : 'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=400';

                return `
                <tr>
                    <td>
                        <img src="${img}" class="rounded object-fit-cover" style="width: 50px; height: 40px;" alt="${item.title}">
                    </td>
                    <td><strong class="text-white">${item.title}</strong></td>
                    <td>${item.user?.name || `Author #${item.user_id || '-'}`}</td>
                    <td>${formatDate(item.created_at)}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="/news/${item.id}" class="btn btn-outline-info" title="View"><i class="fas fa-eye"></i></a>
                            <a href="/admin/news/${item.id}/edit" class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-outline-danger delete-news-btn" data-id="${item.id}" data-title="${item.title}" title="Delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>`;
            })
            .join('');

        tbody.querySelectorAll('.delete-news-btn').forEach((btn) => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                const title = btn.dataset.title;
                if (confirmDelete(`Are you sure you want to delete article "${title}"?`)) {
                    try {
                        await api.news.delete(id);
                        showAlert(alertBox, `Article "${title}" deleted successfully.`, 'success');
                        loadNewsTable();
                    } catch (err) {
                        showAlert(alertBox, `Failed to delete article: ${err.message}`, 'danger');
                    }
                }
            });
        });
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-danger text-center py-4">Error loading news (${err.message})</td></tr>`;
    }
}
