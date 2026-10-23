import { api, storageUrl } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { showAlert, showValidationErrors } from '../../utils.js';

export async function initAdminNewsForm() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    const form = document.getElementById('news-form');
    const alertBox = document.getElementById('news-form-alert');
    if (!form) return;

    const newsId = form.dataset.newsId;
    const isEdit = !!newsId;

    if (isEdit) {
        loadNewsData(newsId);
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        alertBox.innerHTML = '';

        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        try {
            if (isEdit) {
                await api.news.update(newsId, formData);
                showAlert(alertBox, 'News article updated successfully!', 'success');
            } else {
                await api.news.create(formData);
                showAlert(alertBox, 'News article published successfully!', 'success');
            }

            setTimeout(() => {
                window.location.href = '/admin/news';
            }, 1000);
        } catch (err) {
            submitBtn.disabled = false;
            if (err.errors) {
                showValidationErrors(alertBox, err.errors);
            } else {
                showAlert(alertBox, err.message || 'Error saving news article.', 'danger');
            }
        }
    });
}

async function loadNewsData(id) {
    try {
        const res = await api.news.get(id);
        const news = res.news;
        if (!news) return;

        document.getElementById('title').value = news.title || '';
        document.getElementById('content').value = news.content || '';

        const imagesContainer = document.getElementById('existing-images-container');
        if (imagesContainer && news.news_images) {
            imagesContainer.innerHTML = news.news_images
                .map(
                    (img) => `
                <div class="d-inline-block position-relative me-2 mb-2">
                    <img src="${storageUrl(img.image_path)}" class="rounded border border-secondary object-fit-cover" style="width: 80px; height: 80px;" alt="Image">
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-1 delete-img-btn" data-img-id="${img.id}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`
                )
                .join('');

            imagesContainer.querySelectorAll('.delete-img-btn').forEach((btn) => {
                btn.addEventListener('click', async () => {
                    const imgId = btn.dataset.imgId;
                    try {
                        await api.news.deleteImage(imgId);
                        btn.parentElement.remove();
                    } catch (err) {
                        alert(`Failed to delete image: ${err.message}`);
                    }
                });
            });
        }
    } catch (err) {
        console.error(err);
    }
}
