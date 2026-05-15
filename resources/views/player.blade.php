{{-- resources/views/player.blade.php --}}
@extends('layouts.app')

@section('title', 'Player Profile')

@section('content')
@php
    $player = [
        'id'=>1,
        'name'=>'E. Haaland',
        'position'=>'Forward',
        'number'=>9,
        'nationality'=>'Norway',
        'age'=>23,
        'status'=>'active',
        'bio'=>'Prolific goalscorer known for speed and power. Signed in 2022, broke multiple scoring records including most goals in a single season (36).',
        'stats'=>['apps'=>89,'goals'=>81,'assists'=>15],
        'image'=>'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=500'
    ];
@endphp
<div class="container" style="padding: 5rem 0;">
    <div class="grid-2">
        <div>
            <img src="{{ $player['image'] }}" style="width: 100%; border-radius: 8px;" alt="{{ $player['name'] }}">
        </div>
        <div>
            <div class="d-flex align-center gap-2 flex-wrap">
                <h1 style="font-size: 4rem; color: white;">{{ $player['name'] }}</h1>
                @include('components.badge', ['type' => $player['status']])
            </div>
            <p class="text-primary" style="font-size: 1.5rem;">{{ $player['position'] }} • #{{ $player['number'] }}</p>
            <p class="text-muted">{{ $player['nationality'] }} • Age {{ $player['age'] }}</p>
            <p class="mt-3">{{ $player['bio'] }}</p>

            <div class="grid-3 mt-4">
                <div class="card" style="text-align: center; padding: 1rem;">
                    <h2 class="text-primary" style="font-size: 2rem;">{{ $player['stats']['apps'] }}</h2>
                    <p class="text-muted small">Appearances</p>
                </div>
                <div class="card" style="text-align: center; padding: 1rem;">
                    <h2 class="text-primary" style="font-size: 2rem;">{{ $player['stats']['goals'] }}</h2>
                    <p class="text-muted small">Goals</p>
                </div>
                <div class="card" style="text-align: center; padding: 1rem;">
                    <h2 class="text-primary" style="font-size: 2rem;">{{ $player['stats']['assists'] }}</h2>
                    <p class="text-muted small">Assists</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
