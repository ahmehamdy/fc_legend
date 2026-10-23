import { api, isAuthenticated } from '../api.js';
import { showAlert, showValidationErrors, cacheMatchEvent } from '../utils.js';

export async function initMatchEvents() {
    const container = document.getElementById('match-events-container');
    if (!container) return;

    const fixtureId = container.dataset.fixtureId;
    if (!fixtureId) return;

    loadPlayersForSelect();

    const form = document.getElementById('add-match-event-form');
    const alertBox = document.getElementById('match-event-alert');

    if (!isAuthenticated()) {
        const loggerCard = document.getElementById('event-logger-card');
        if (loggerCard) {
            loggerCard.innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-lock me-2"></i> Log in as Admin or Journalist to record live match events.
                    <a href="/login" class="alert-link ms-2">Login Now</a>
                </div>`;
        }
    }

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            alertBox.innerHTML = '';

            const playerId = document.getElementById('player_id').value;
            const type = document.getElementById('type').value;
            const team = document.getElementById('team').value;
            const minute = document.getElementById('minute').value;
            const relatedPlayerId = document.getElementById('related_player_id').value || null;

            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            try {
                const body = {
                    player_id: parseInt(playerId, 10),
                    type,
                    team,
                    minute: parseInt(minute, 10),
                    related_player_id: relatedPlayerId ? parseInt(relatedPlayerId, 10) : null,
                };

                const res = await api.matchEvents.create(fixtureId, body);
                cacheMatchEvent(fixtureId, res['match event'] || body);

                showAlert(alertBox, 'Match event recorded successfully!', 'success');
                form.reset();
                setTimeout(() => window.location.reload(), 1000);
            } catch (err) {
                submitBtn.disabled = false;
                if (err.errors) {
                    showValidationErrors(alertBox, err.errors);
                } else {
                    showAlert(alertBox, err.message || 'Error recording match event.', 'danger');
                }
            }
        });
    }
}

async function loadPlayersForSelect() {
    const playerSelect = document.getElementById('player_id');
    const relatedSelect = document.getElementById('related_player_id');

    if (!playerSelect) return;

    try {
        const res = await api.players.list(1);
        const players = res.players?.data || res.players || [];

        const options = players
            .map((p) => `<option value="${p.id}">#${p.number} ${p.name} (${p.position})</option>`)
            .join('');

        playerSelect.innerHTML = '<option value="">-- Select Player --</option>' + options;
        if (relatedSelect) {
            relatedSelect.innerHTML = '<option value="">-- None / Optional --</option>' + options;
        }
    } catch {
        playerSelect.innerHTML = '<option value="">Unable to load players</option>';
    }
}
