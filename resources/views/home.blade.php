{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'FC Dynamo - Home of Champions')

@section('content')
{{-- Hero Section --}}
<section class="hero">
    <div class="container">
        <h1>FORGED IN <span>GLORY</span></h1>
        <p style="font-size: 1.5rem; margin-bottom: 2rem;">Est. 1923 • 12 League Titles • 7 Cups</p>
        <a href="/matches" class="btn-primary">Upcoming Matches →</a>
    </div>
</section>

{{-- Latest News Section --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Latest News</h2>
            <a href="/news" class="text-primary">View All →</a>
        </div>
        @php
            $latestNews = [
                ['id' => 1, 'title' => 'Dynamo signs Brazilian striker', 'date' => '2025-03-28', 'image' => 'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=800', 'excerpt' => 'Record-breaking transfer for the club...'],
                ['id' => 2, 'title' => 'Match report: Derby victory', 'date' => '2025-03-20', 'image' => 'https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=800', 'excerpt' => '3-1 win against fierce rivals...'],
                ['id' => 3, 'title' => 'Academy graduate makes debut', 'date' => '2025-03-15', 'image' => 'https://images.unsplash.com/photo-1577223625816-7546f13df25d?w=800', 'excerpt' => '18-year-old midfielder impresses...'],
            ];
        @endphp
        <div class="grid-3">
            @foreach($latestNews as $item)
                <div class="card news-card">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                    <div class="card-body">
                        <span class="news-date">{{ date('M d, Y', strtotime($item['date'])) }}</span>
                        <h3 style="color: white; font-family: 'Bebas Neue', cursive; font-size: 1.5rem;">{{ $item['title'] }}</h3>
                        <p class="text-muted mt-1">{{ $item['excerpt'] }}</p>
                        <a href="/news/{{ $item['id'] }}" class="text-primary mt-2 d-inline-block">Read More →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Upcoming Matches Section --}}
<section class="section section-dark">
    <div class="container">
        <h2 class="section-title">Upcoming Matches</h2>
        @php
            $upcoming = [
                ['opponent' => 'FC Northside', 'date' => '2025-04-12', 'time' => '20:00', 'competition' => 'Premier League', 'home' => true],
                ['opponent' => 'AFC Rangers', 'date' => '2025-04-19', 'time' => '17:30', 'competition' => 'Cup Quarterfinal', 'home' => false],
                ['opponent' => 'City Warriors', 'date' => '2025-04-26', 'time' => '15:00', 'competition' => 'Premier League', 'home' => true],
            ];
        @endphp
        <div class="grid-3">
            @foreach($upcoming as $match)
                <div class="card match-card">
                    <span class="badge-active" style="background-color: var(--primary); margin-bottom: 0.5rem; display: inline-block;">{{ $match['competition'] }}</span>
                    <h3 style="color: white; font-size: 1.5rem;">{{ $match['home'] ? 'vs ' . $match['opponent'] : '@ ' . $match['opponent'] }}</h3>
                    <p class="text-muted">{{ date('M d, Y', strtotime($match['date'])) }} • {{ $match['time'] }}</p>
                    <span class="badge-active" style="background-color: #6c757d;">Tickets Soon</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Featured Players Section --}}
<section class="section">
    <div class="container">
        <h2 class="section-title">Featured Stars</h2>
        @php
            $featured = [
                ['id' => 1, 'name' => 'E. Rodriguez', 'position' => 'Forward', 'number' => 9, 'image' => 'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?w=400', 'status' => 'active'],
                ['id' => 2, 'name' => 'M. Tanaka', 'position' => 'Midfielder', 'number' => 8, 'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=400', 'status' => 'active'],
                ['id' => 3, 'name' => 'L. Costa', 'position' => 'Defender', 'number' => 4, 'image' => 'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=400', 'status' => 'injured'],
                ['id' => 4, 'name' => 'J. van Dijk', 'position' => 'Goalkeeper', 'number' => 1, 'image' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?w=400', 'status' => 'active'],
            ];
        @endphp
        <div class="grid-4">
            @foreach($featured as $player)
                <div class="card player-card">
                    <div style="position: relative;">
                        <img src="{{ $player['image'] }}" alt="{{ $player['name'] }}">
                        <div style="position: absolute; top: 10px; right: 10px;">
                            @include('components.badge', ['type' => $player['status']])
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>{{ $player['name'] }}</h3>
                        <p class="text-muted">{{ $player['position'] }} • #{{ $player['number'] }}</p>
                        <a href="/player/{{ $player['id'] }}" class="btn-outline btn-sm mt-2 d-inline-block">View Profile</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
