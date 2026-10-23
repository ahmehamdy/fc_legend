@extends('layouts.app')

@section('title', 'FC Legend - Club Legends')
@section('page', 'legends')

@section('content')
<div class="container py-5 my-4">
    <div class="text-center mb-5">
        <span class="badge bg-warning text-dark text-uppercase px-3 py-2 fs-6 mb-2"><i class="fas fa-trophy me-1"></i> Hall of Fame</span>
        <h1 class="heading-font display-3 text-white mb-2">CLUB <span class="text-danger">LEGENDS</span></h1>
        <p class="lead text-secondary max-w-2xl mx-auto">Honoring the iconic players who defined FC Legend history with extraordinary passion, goals, and trophies.</p>
    </div>

    <div class="row" id="players-grid">
        <x-spinner message="Loading club legends..." />
    </div>

    <x-pagination id="pagination-container" />
</div>
@endsection
