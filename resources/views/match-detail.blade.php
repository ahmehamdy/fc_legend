@extends('layouts.app')

@section('title', 'Match Details')
@section('page', 'match-detail')

@section('content')

    <div id="match-detail-container" data-fixture-id="{{ $fixture->id }}" class="container py-5">

        {{-- Match Header --}}
        <div class="card bg-dark text-white border-secondary p-4 mb-4 shadow-lg text-center">

            <span id="match-league" class="badge bg-secondary mb-2 align-self-center">
                League Match
            </span>

            <p class="text-secondary small mb-3">
                <i class="far fa-calendar-alt me-1"></i>
                <span id="match-date">Loading...</span>
            </p>

            <div class="d-flex justify-content-center align-items-center gap-4 my-3">

                <h2 class="heading-font display-4 text-white">
                    FC LEGEND
                </h2>

                <div id="match-score"
                    class="display-3 font-monospace fw-bold text-danger px-4 py-2 bg-black rounded border border-secondary">
                    VS
                </div>

                <h2 id="match-opponent" class="heading-font display-4 text-white">
                    —
                </h2>

            </div>

            <div id="match-status" class="mt-2">
                <span class="badge bg-secondary">
                    Loading...
                </span>
            </div>

        </div>


        {{-- Match Events Timeline --}}
        <div class="card bg-dark text-white border-secondary p-4 shadow-sm">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h3 class="heading-font fs-3 text-white mb-0">
                    <i class="fas fa-stream me-2 text-danger"></i>
                    Match Events Timeline
                </h3>

                <a id="event-center-link" href="{{ route('event.create', $fixture->id) }}"
                    class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-edit me-1"></i>
                    Live Event Center
                </a>

            </div>

            <ul id="match-events-timeline" class="list-group list-group-flush border-top border-secondary">

                <li class="list-group-item bg-dark text-secondary text-center">
                    Loading match events...
                </li>

            </ul>

        </div>

    </div>

@endsection
