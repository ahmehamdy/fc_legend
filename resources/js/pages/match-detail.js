import { api } from '../api.js';

import {
    showLoading,
    formatDate,
    statusBadge,
    getMatchEventsCache
} from '../utils.js';

import echo from '../echo.js';

console.log('🔥 MATCH DETAIL JS LOADED');


export async function initMatchDetail() {

    console.log('🔥 INIT MATCH DETAIL CALLED');

    const container =
        document.getElementById('match-detail-container');

    console.log('Container:', container);

    if (!container) {
        console.log('❌ match-detail-container not found');
        return;
    }


    const fixtureId =
        container.dataset.fixtureId;

    console.log('Fixture ID:', fixtureId);
    console.log('Echo:', echo);


    if (!fixtureId) {
        console.log('❌ Fixture ID not found');
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Live Match Events
    |--------------------------------------------------------------------------
    */

    echo
        .channel(`fixture.${fixtureId}`)
        .listen('.match.event.created', (event) => {

            console.log('🔥🔥 NEW MATCH EVENT:', event);

            addEventToTimeline(event);

            updateLiveScore(event);

        });


    /*
    |--------------------------------------------------------------------------
    | Load Match Details
    |--------------------------------------------------------------------------
    */

    // showLoading(
    //     container,
    //     'Loading match center details...'
    // );


    try {

        const res =
            await api.fixtures.get(fixtureId);

        const fixture =
            res.fixture;


        /*
        |--------------------------------------------------------------------------
        | Fixture Not Found
        |--------------------------------------------------------------------------
        */

        if (!fixture) {

            container.innerHTML = `
                <div class="alert alert-warning">
                    Fixture not found.
                </div>
            `;

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Match Data
        |--------------------------------------------------------------------------
        */

        document.getElementById('match-league')
            .textContent =
            fixture.league || 'League Match';


        document.getElementById('match-date')
            .textContent =
            formatDate(fixture.match_date);


        document.getElementById('match-opponent')
            .textContent =
            fixture.opponent;


        /*
        |--------------------------------------------------------------------------
        | Score
        |--------------------------------------------------------------------------
        */

        const isFinished =
            fixture.status === 'finished';

        const isLive =
            fixture.status === 'live';


        const scoreText =
            isFinished || isLive
                ? `${fixture.home_score ?? 0} - ${fixture.away_score ?? 0}`
                : 'VS';


        document.getElementById('match-score')
            .textContent =
            scoreText;


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        const statusContainer =
            document.getElementById('match-status');


        statusContainer.innerHTML =
            statusBadge(fixture.status);


        /*
        |--------------------------------------------------------------------------
        | Result
        |--------------------------------------------------------------------------
        */

        if (fixture.result) {

            const resultClass =
                fixture.result === 'win'
                    ? 'success'
                    : fixture.result === 'loss'
                        ? 'danger'
                        : 'warning';


            statusContainer.insertAdjacentHTML(
                'beforeend',
                `
                <span class="badge bg-${resultClass} ms-2 text-uppercase fs-6">
                    ${fixture.result}
                </span>
                `
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Match Events
        |--------------------------------------------------------------------------
        */

        const events =
            fixture.match_events ||
            getMatchEventsCache(fixtureId) ||
            [];


        renderTimeline(
            events,
            fixture
        );


    } catch (err) {

        console.error(
            '❌ Match details error:',
            err
        );


        container.innerHTML = `
            <div class="alert alert-danger">
                Error loading match details (${err.message}).
            </div>
        `;
    }
}


/*
|--------------------------------------------------------------------------
| Render Timeline
|--------------------------------------------------------------------------
*/

function renderTimeline(events, fixture) {

    const timeline =
        document.getElementById(
            'match-events-timeline'
        );


    if (!timeline) {

        console.log(
            '❌ Timeline not found'
        );

        return;
    }


    if (!events.length) {

        timeline.innerHTML = `
            <li class="list-group-item bg-dark text-secondary text-center">
                No match timeline events logged yet.
            </li>
        `;

        return;
    }


    const iconMap = {

        goal:
            'fa-futbol text-success',

        own_goal:
            'fa-futbol text-danger',

        yellow_card:
            'fa-square text-warning',

        red_card:
            'fa-square text-danger',

        substitution:
            'fa-exchange-alt text-info',

        start_match:
            'fa-play text-primary',

        end_match:
            'fa-flag-checkered text-light'
    };


    timeline.innerHTML =
        events.map(event => {

            const icon =
                iconMap[event.type] ||
                'fa-info-circle text-muted';


            const playerName =
                event.player?.name ||
                `Player #${event.player_id || ''}`;


            const relatedPlayer =
                event.related_player?.name
                    ? ` (Assisted by/Sub for: ${event.related_player.name})`
                    : '';


            const teamLabel =
                event.team === 'home'
                    ? 'FC Legend'
                    : fixture.opponent;


            return `
                <li class="list-group-item bg-dark text-white border-secondary d-flex align-items-center justify-content-between">

                    <div>

                        <span class="badge bg-secondary me-2">
                            ${event.minute}'
                        </span>

                        <i class="fas ${icon} me-2"></i>

                        <strong>
                            ${playerName}
                        </strong>

                        ${relatedPlayer}

                    </div>

                    <span class="small text-secondary">
                        ${teamLabel} •
                        ${event.type
                            .replace('_', ' ')
                            .toUpperCase()}
                    </span>

                </li>
            `;

        }).join('');
}


/*
|--------------------------------------------------------------------------
| Add Live Event
|--------------------------------------------------------------------------
*/

function addEventToTimeline(event) {

    const timeline =
        document.getElementById(
            'match-events-timeline'
        );


    if (!timeline) {

        console.log(
            '❌ Timeline not found'
        );

        return;
    }


    const playerName =
        event.player?.name ||
        'Unknown player';


    const teamLabel =
        event.team === 'home'
            ? 'FC Legend'
            : 'Opponent';


    const iconMap = {

        goal:
            'fa-futbol text-success',

        own_goal:
            'fa-futbol text-danger',

        yellow_card:
            'fa-square text-warning',

        red_card:
            'fa-square text-danger',

        substitution:
            'fa-exchange-alt text-info',

        start_match:
            'fa-play text-primary',

        end_match:
            'fa-flag-checkered text-light'
    };


    const icon =
        iconMap[event.type] ||
        'fa-info-circle text-muted';


    const item =
        document.createElement('li');


    item.className =
        'list-group-item bg-dark text-white border-secondary d-flex align-items-center justify-content-between';


    item.innerHTML = `
        <div>

            <span class="badge bg-secondary me-2">
                ${event.minute}'
            </span>

            <i class="fas ${icon} me-2"></i>

            <strong>
                ${playerName}
            </strong>

        </div>

        <span class="small text-secondary">
            ${teamLabel} •
            ${event.type
                .replace('_', ' ')
                .toUpperCase()}
        </span>
    `;


    timeline.prepend(item);
}


/*
|--------------------------------------------------------------------------
| Update Live Score
|--------------------------------------------------------------------------
*/

function updateLiveScore(event) {

    if (
        event.type !== 'goal' &&
        event.type !== 'own_goal'
    ) {
        return;
    }


    const scoreElement =
        document.getElementById(
            'match-score'
        );


    if (!scoreElement) {

        console.log(
            '❌ Score element not found'
        );

        return;
    }


    const scores =
        scoreElement.textContent
            .trim()
            .split('-')
            .map(
                score =>
                    parseInt(score.trim()) || 0
            );


    let homeScore =
        scores[0];

    let awayScore =
        scores[1];


    if (event.team === 'home') {

        homeScore++;

    } else {

        awayScore++;

    }


    scoreElement.textContent =
        `${homeScore} - ${awayScore}`;
}

