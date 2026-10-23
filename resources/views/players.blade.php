@extends('layouts.app')

@section('title', 'FC Legend - First Team Squad')
@section('page', 'players')

@section('content')
<div class="container py-5 my-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="heading-font display-4 text-white mb-0"><i class="fas fa-users me-2 text-danger"></i> First Team Squad</h1>
            <p class="text-secondary mb-0">FC Legend active squad roster and player profiles.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <select id="position-filter" class="form-select bg-dark text-white border-secondary" style="width: 180px;">
                <option value="all">All Positions</option>
                <option value="Goalkeeper">Goalkeepers</option>
                <option value="Defender">Defenders</option>
                <option value="Midfielder">Midfielders</option>
                <option value="Forward">Forwards</option>
            </select>
            <input type="text" id="player-search" class="form-control bg-dark text-white border-secondary" placeholder="Search player name..." style="width: 220px;">
        </div>
    </div>

    <div class="row" id="players-grid">
        <x-spinner message="Loading squad roster..." />
    </div>

    <x-pagination id="pagination-container" />
</div>
@endsection
