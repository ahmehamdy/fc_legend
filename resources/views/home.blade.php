@extends('layouts.app')

@section('title', 'FC Legend - Official Club Home')
{{-- @section('page', 'home') --}}

@section('content')
    <section class="hero bg-dark text-white py-5 mb-5 border-bottom border-secondary position-relative overflow-hidden">
        <div class="container py-5 text-center position-relative z-1">
            <span class="badge bg-danger text-uppercase tracking-wider px-3 py-2 mb-3">Est. 1923 • 12 League Titles • 7
                Domestic Cups</span>
            <h1 class="heading-font display-1 text-white text-uppercase tracking-wide mb-3">FORGED IN <span
                    class="text-danger">GLORY</span></h1>
            <p class="lead text-light max-w-2xl mx-auto mb-4">Welcome to the official home of FC Legend. Follow live
                matches, read exclusive club news, and explore first-team squad statistics.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="/matches" class="btn btn-danger btn-lg px-4"><i class="fas fa-futbol me-2"></i> Upcoming
                    Fixtures</a>
                <a href="/players" class="btn btn-outline-light btn-lg px-4"><i class="fas fa-users me-2"></i> Explore
                    Squad</a>
            </div>
        </div>
    </section>

    <div class="container my-5">
        {{-- Latest News --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="heading-font display-5 text-white mb-0"><i class="fas fa-newspaper me-2 text-danger"></i> Latest
                    News</h2>
                <p class="text-secondary mb-0">Stay updated with official club news and press announcements.</p>
            </div>
            <a href="{{ route('matches') }}" class="btn btn-outline-danger btn-sm">View All News →</a>
        </div>
        <div class="row">

            @forelse($news as $item)
                @php
                    $image = $item->news_images->first();
                @endphp

                <div class="col-md-4 mb-4">

                    <div class="card h-100 bg-dark text-white border-secondary shadow-sm">

                        @if ($image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top object-fit-cover"
                                style="height: 200px;" alt="{{ $item->title }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=800"
                                class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $item->title }}">
                        @endif

                        <div class="card-body d-flex flex-column">

                            <small class="text-danger mb-1">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $item->created_at->format('M d, Y') }}
                            </small>

                            <h5 class="heading-font fs-4 text-white">
                                {{ $item->title }}
                            </h5>

                            <p class="text-secondary small flex-grow-1">
                                {{ Str::limit($item->content, 100) }}
                            </p>

                            <a href="/news/{{ $item->id }}" class="btn btn-outline-danger btn-sm mt-2 align-self-start">
                                Read Article →
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-secondary">
                        No news articles available.
                    </div>
                </div>
            @endforelse

        </div>

        {{-- Upcoming Matches --}}
        <div class="d-flex justify-content-between align-items-center mt-5 mb-4 pt-4 border-top border-secondary">
            <div>
                <h2 class="heading-font display-5 text-white mb-0"><i class="fas fa-calendar-alt me-2 text-danger"></i> Next
                    Matches</h2>
                <p class="text-secondary mb-0">Upcoming fixtures and recent match scores.</p>
            </div>
            <a href="/matches" class="btn btn-outline-danger btn-sm">View All Fixtures →</a>
        </div>
        <div class="row">

            @forelse($fixtures as $fixture)
                @php
                    $isFinished = $fixture->status === 'finished';

                    $scoreDisplay = $isFinished
                        ? ($fixture->home_score ?? 0) . ' - ' . ($fixture->away_score ?? 0)
                        : 'VS';
                @endphp

                <div class="col-md-4 mb-4">

                    <div class="card bg-dark text-white border-secondary text-center p-3 h-100">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="badge bg-secondary">
                                {{ $fixture->league ?? 'League Match' }}
                            </span>

                            <span class="badge bg-danger text-uppercase">
                                {{ $fixture->status }}
                            </span>

                        </div>

                        <h4 class="heading-font fs-3 my-2">
                            FC LEGEND
                            {{ $scoreDisplay }}
                            {{ $fixture->opponent }}
                        </h4>

                        <p class="text-secondary small mb-3">
                            <i class="far fa-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($fixture->match_date)->format('M d, Y - H:i') }}
                        </p>

                        <a href="/matches/{{ $fixture->id }}" class="btn btn-sm btn-danger w-100">
                            Match Details
                        </a>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-secondary">
                        No fixtures scheduled.
                    </div>
                </div>
            @endforelse

        </div>

        {{-- FFeatured Squad Stars --}}
        <div class="d-flex justify-content-between align-items-center mt-5 mb-4 pt-4 border-top border-secondary">
            <div>
                <h2 class="heading-font display-5 text-white mb-0"><i class="fas fa-star me-2 text-danger"></i> Featured
                    Stars</h2>
                <p class="text-secondary mb-0">Meet the athletes driving FC Legend to victory.</p>
            </div>
            <a href="/players" class="btn btn-outline-danger btn-sm">Full First Team →</a>
        </div>
        <div class="row">

            @forelse($players as $player)
                <div class="col-6 col-md-3 mb-4">

                    <div class="card bg-dark text-white border-secondary text-center h-100">

                        <div class="position-relative">

                            @if ($player->image)
                                <img src="{{ asset('storage/' . $player->image) }}" class="card-img-top object-fit-cover"
                                    style="height: 240px;" alt="{{ $player->name }}">
                            @endif

                            <span class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-danger">
                                    {{ $player->status ?? 'active' }}
                                </span>
                            </span>

                        </div>

                        <div class="card-body">

                            <h5 class="heading-font fs-4 text-white mb-0">
                                #{{ $player->number }} {{ $player->name }}
                            </h5>

                            <small class="text-secondary d-block mb-2">
                                {{ $player->position }} • {{ $player->nationality }}
                            </small>

                            <a href="/players/{{ $player->id }}" class="btn btn-outline-danger btn-sm w-100">
                                View Bio
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-secondary">
                        No squad players found.
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection
