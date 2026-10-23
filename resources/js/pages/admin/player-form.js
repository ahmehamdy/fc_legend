import { api, storageUrl } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { showAlert, showValidationErrors } from '../../utils.js';

export async function initAdminPlayerForm() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    const form = document.getElementById('player-form');
    const alertBox = document.getElementById('player-form-alert');
    if (!form) return;

    const playerId = form.dataset.playerId;
    const isEdit = !!playerId;

    if (isEdit) {
        loadPlayerData(playerId);
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        alertBox.innerHTML = '';

        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        try {
            if (isEdit) {
                await api.players.update(playerId, formData);
                showAlert(alertBox, 'Player updated successfully! Redirecting...', 'success');
            } else {
                await api.players.create(formData);
                showAlert(alertBox, 'Player created successfully! Redirecting...', 'success');
            }

            setTimeout(() => {
                window.location.href = '/admin/players';
            }, 1000);
        } catch (err) {
            submitBtn.disabled = false;
            if (err.errors) {
                showValidationErrors(alertBox, err.errors);
            } else {
                showAlert(alertBox, err.message || 'Error saving player details.', 'danger');
            }
        }
    });
}

async function loadPlayerData(id) {
    try {
        const res = await api.players.get(id);
        const player = res.player;
        if (!player) return;

        document.getElementById('name').value = player.name || '';
        document.getElementById('age').value = player.age || '';
        document.getElementById('number').value = player.number || '';
        document.getElementById('position').value = player.position || 'Forward';
        document.getElementById('nationality').value = player.nationality || '';
        document.getElementById('bio').value = player.bio || '';
        if (document.getElementById('height')) document.getElementById('height').value = player.height || '';
        if (document.getElementById('weight')) document.getElementById('weight').value = player.weight || '';

        const imgPreview = document.getElementById('current-image-preview');
        if (imgPreview && player.image) {
            imgPreview.src = storageUrl(player.image);
            imgPreview.style.display = 'block';
        }
    } catch (err) {
        console.error(err);
    }
}
