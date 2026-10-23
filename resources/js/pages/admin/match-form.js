import { api } from '../../api.js';
import { initAdminGuard, updateAdminUserDisplay } from '../../auth.js';
import { showAlert, showValidationErrors } from '../../utils.js';

export async function initAdminMatchForm() {
    if (!initAdminGuard()) return;
    updateAdminUserDisplay();

    const form = document.getElementById('match-form');
    const alertBox = document.getElementById('match-form-alert');
    if (!form) return;

    const fixtureId = form.dataset.fixtureId;
    const isEdit = !!fixtureId;

    if (isEdit) {
        loadMatchData(fixtureId);
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        alertBox.innerHTML = '';

        const opponent = document.getElementById('opponent').value.trim();
        const match_date = document.getElementById('match_date').value;
        const league = document.getElementById('league').value.trim();
        const status = document.getElementById('status').value;
        const result = document.getElementById('result')?.value || null;

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        try {
            const body = { opponent, match_date, league, status };
            if (result) body.result = result;

            if (isEdit) {
                await api.fixtures.update(fixtureId, body);
                showAlert(alertBox, 'Fixture updated successfully!', 'success');
            } else {
                await api.fixtures.create(body);
                showAlert(alertBox, 'Fixture created successfully!', 'success');
            }

            setTimeout(() => {
                window.location.href = '/admin/matches';
            }, 1000);
        } catch (err) {
            submitBtn.disabled = false;
            if (err.errors) {
                showValidationErrors(alertBox, err.errors);
            } else {
                showAlert(alertBox, err.message || 'Error saving fixture.', 'danger');
            }
        }
    });
}

async function loadMatchData(id) {
    try {
        const res = await api.fixtures.get(id);
        const f = res.fixture;
        if (!f) return;

        document.getElementById('opponent').value = f.opponent || '';
        if (f.match_date) {
            const dt = new Date(f.match_date);
            document.getElementById('match_date').value = dt.toISOString().slice(0, 16);
        }
        document.getElementById('league').value = f.league || '';
        document.getElementById('status').value = f.status || 'upcoming';
        if (document.getElementById('result')) document.getElementById('result').value = f.result || '';
    } catch (err) {
        console.error(err);
    }
}
