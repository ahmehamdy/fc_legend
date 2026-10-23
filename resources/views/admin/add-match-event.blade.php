@extends('layouts.app')

@section('title', 'Live Event Center')
@section('page', 'match-events')

@section('content')

<div
    id="match-event-container"
    data-fixture-id="{{ $fixture->id }}"
    class="container py-5"
>

    {{-- Header --}}
    <div class="card bg-dark text-white border-secondary shadow-lg mb-4">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <span class="badge bg-danger mb-2">
                        LIVE EVENT CENTER
                    </span>

                    <h1 class="heading-font text-white mb-1">
                        FC LEGEND
                        <span class="text-secondary mx-2">VS</span>
                        {{ $fixture->opponent }}
                    </h1>

                    <p class="text-secondary mb-0">
                        <i class="far fa-calendar-alt me-1"></i>
                        {{ $fixture->match_date }}
                    </p>
                </div>

                <div class="text-center">

                    <div
                        id="live-score"
                        class="display-4 font-monospace fw-bold text-danger"
                    >
                        {{ $fixture->home_score ?? 0 }}
                        -
                        {{ $fixture->away_score ?? 0 }}
                    </div>

                    <div id="match-status">
                        <span class="badge bg-secondary">
                            {{ strtoupper($fixture->status) }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Add Event --}}
    <div class="card bg-dark text-white border-secondary shadow-lg mb-4">

        <div class="card-header bg-black border-secondary">

            <h3 class="heading-font mb-0">
                <i class="fas fa-plus-circle text-danger me-2"></i>
                Add Match Event
            </h3>

        </div>

        <div class="card-body p-4">

            <form id="match-event-form">

                <div class="row g-3">

                    {{-- Event Type --}}
                    <div class="col-md-6">

                        <label
                            for="event-type"
                            class="form-label text-white"
                        >
                            Event Type
                        </label>

                        <select
                            id="event-type"
                            name="type"
                            class="form-select bg-dark text-white border-secondary"
                            required
                        >

                            <option value="">
                                Select event
                            </option>

                            <option value="goal">
                                ⚽ Goal
                            </option>

                            <option value="own_goal">
                                ⚽ Own Goal
                            </option>

                            <option value="yellow_card">
                                🟨 Yellow Card
                            </option>

                            <option value="red_card">
                                🟥 Red Card
                            </option>

                            <option value="substitution">
                                🔄 Substitution
                            </option>

                            <option value="start_match">
                                ▶️ Start Match
                            </option>

                            <option value="end_match">
                                🏁 End Match
                            </option>

                        </select>

                    </div>


                    {{-- Team --}}
                    <div class="col-md-6">

                        <label
                            for="event-team"
                            class="form-label text-white"
                        >
                            Team
                        </label>

                        <select
                            id="event-team"
                            name="team"
                            class="form-select bg-dark text-white border-secondary"
                            required
                        >

                            <option value="">
                                Select team
                            </option>

                            <option value="home">
                                FC Legend
                            </option>

                            <option value="away">
                                {{ $fixture->opponent }}
                            </option>

                        </select>

                    </div>


                    {{-- Player --}}
                    <div class="col-md-6">

                        <label
                            for="event-player"
                            class="form-label text-white"
                        >
                            Player
                        </label>

                        <select
                            id="event-player"
                            name="player_id"
                            class="form-select bg-dark text-white border-secondary"
                            required
                        >

                            <option value="">
                                Select player
                            </option>

                            {{-- Players will be loaded using JS --}}

                        </select>

                    </div>


                    {{-- Related Player --}}
                    <div
                        id="related-player-wrapper"
                        class="col-md-6 d-none"
                    >

                        <label
                            for="related-player"
                            class="form-label text-white"
                        >
                            Related Player
                        </label>

                        <select
                            id="related-player"
                            name="related_player_id"
                            class="form-select bg-dark text-white border-secondary"
                        >

                            <option value="">
                                Select related player
                            </option>

                            {{-- Players will be loaded using JS --}}

                        </select>

                    </div>


                    {{-- Minute --}}
                    <div class="col-md-6">

                        <label
                            for="event-minute"
                            class="form-label text-white"
                        >
                            Minute
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                id="event-minute"
                                name="minute"
                                class="form-control bg-dark text-white border-secondary"
                                min="0"
                                max="130"
                                placeholder="e.g. 45"
                                required
                            >

                            <span class="input-group-text bg-black text-secondary border-secondary">
                                '
                            </span>

                        </div>

                    </div>


                    {{-- Submit --}}
                    <div class="col-12 mt-4">

                        <button
                            type="submit"
                            id="add-event-btn"
                            class="btn btn-danger w-100"
                        >

                            <i class="fas fa-plus me-2"></i>
                            Add Match Event

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- Current Events --}}
    <div class="card bg-dark text-white border-secondary shadow-lg">

        <div class="card-header bg-black border-secondary">

            <div class="d-flex justify-content-between align-items-center">

                <h3 class="heading-font mb-0">
                    <i class="fas fa-stream text-danger me-2"></i>
                    Match Timeline
                </h3>

                <span
                    id="events-count"
                    class="badge bg-secondary"
                >
                    0 Events
                </span>

            </div>

        </div>


        <div class="card-body p-0">

            <ul
                id="match-events-timeline"
                class="list-group list-group-flush"
            >

                <li class="list-group-item bg-dark text-secondary text-center py-4">
                    No events yet.
                </li>

            </ul>

        </div>

    </div>

</div>

@endsection
