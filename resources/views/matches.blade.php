{{-- resources/views/matches.blade.php --}}
@extends('layouts.app')

@section('title', 'Fixtures & Results')

@section('content')
    <div class="container" style="padding: 3rem 0;">
        {{-- Page Header --}}
        <div class="d-flex justify-between align-center flex-wrap" style="margin-bottom: 2rem;">
            <div>
                <h1 style="font-size: 3.5rem; color: white; font-family: 'Bebas Neue', cursive;">Fixtures & Results</h1>
                <p class="text-muted" style="margin-top: 0.5rem;">Stay updated with all matches of FC Dynamo</p>
            </div>
            <div style="margin-top: 1rem;">
                <div class="d-flex gap-2" style="flex-wrap: wrap;">
                    <select class="form-control" style="width: auto; min-width: 150px;" onchange="filterMatches()">
                        <option value="all">All Matches</option>
                        <option value="upcoming">Upcoming</option>
                        <option value="finished">Finished</option>
                    </select>
                    <select class="form-control" style="width: auto; min-width: 150px;" onchange="filterMatches()">
                        <option value="all">All Competitions</option>
                        <option value="premier">Premier League</option>
                        <option value="cup">Cup</option>
                        <option value="champions">Champions League</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Statistics Summary --}}
        <div class="grid-4" style="margin-bottom: 2rem;">
            <div class="card" style="text-align: center; padding: 1rem;">
                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                    {{ $stats['total'] ?? 32 }}</p>
                <p class="text-muted small">Total Matches</p>
            </div>
            <div class="card" style="text-align: center; padding: 1rem;">
                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                    {{ $stats['live'] ?? 3 }}</p>
                <p class="text-muted small"><i class="fas fa-wifi" style="color: #b31111;"></i> live</p>
            </div>
            <div class="card" style="text-align: center; padding: 1rem;">
                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                    {{ $stats['won'] ?? 18 }}</p>
                <p class="text-muted small"><i class="fas fa-trophy" style="color: #198754;"></i> Wins</p>
            </div>
            <div class="card" style="text-align: center; padding: 1rem;">
                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                    {{ $stats['drawn'] ?? 8 }}</p>
                <p class="text-muted small"><i class="fas fa-equals" style="color: #ffc107;"></i> Draws</p>
            </div>
            <div class="card" style="text-align: center; padding: 1rem;">
                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                    {{ $stats['lost'] ?? 6 }}</p>
                <p class="text-muted small"><i class="fas fa-times" style="color: #dc3545;"></i> Losses</p>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <ul
            style="display: flex; gap: 0.5rem; list-style: none; border-bottom: 1px solid var(--dark-border); padding-bottom: 0.5rem; margin-bottom: 2rem; flex-wrap: wrap;">
            <li>
                <button class="btn-outline btn-sm filter-btn active" data-filter="all" onclick="setFilter('all', this)"
                    style="border-color: var(--primary); color: var(--primary);">
                    <i class="fas fa-list"></i> All Matches
                </button>
            </li>
            <li>
                <button class="btn-outline btn-sm filter-btn" data-filter="upcoming" onclick="setFilter('upcoming', this)">
                    <i class="fas fa-calendar-alt"></i> Upcoming
                </button>
            </li>
            <li>
                <button class="btn-outline btn-sm filter-btn" data-filter="finished" onclick="setFilter('finished', this)">
                    <i class="fas fa-check-circle"></i> Finished
                </button>
            </li>
            <li>
                <button class="btn-outline btn-sm filter-btn" data-filter="live" onclick="setFilter('live', this)">
                    <i class="fas fa-wifi"></i> live
                </button>
            </li>
            <li style="margin-left: auto;">
                <div class="d-flex gap-2">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search matches..."
                        style="width: 200px;" onkeyup="searchMatches()">
                    <button class="btn-primary btn-sm" onclick="searchMatches()"><i class="fas fa-search"></i></button>
                </div>
            </li>
        </ul>

        {{-- Matches List --}}
        <div id="matchesContainer">

            @forelse($matches as $match)
                <div class="match-item card" style="padding: 1.5rem; margin-bottom: 1rem; transition: all 0.3s ease;"
                    data-status="{{ $match['status'] }}"
                    data-competition="{{ strtolower(str_replace(' ', '-', $match['competition'])) }}"
                    data-search="{{ strtolower($match['home_team'] . ' ' . $match['away_team'] . ' ' . $match['competition']) }}">
                    <div
                        style="display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; justify-content: space-between;">
                        {{-- Teams --}}
                        <div style="display: flex; align-items: center; gap: 1.5rem; flex: 1; min-width: 200px;">
                            <div style="text-align: center; min-width: 80px;">
                                <div style="font-size: 2rem;">{{ $match['home_logo'] }}</div>
                                <p style="color: white; font-size: 0.8rem; margin-top: 0.25rem;">{{ $match['home_team'] }}
                                </p>
                            </div>

                            <div style="text-align: center; min-width: 80px;">
                                @if ($match['status'] == 'finished')
                                    <div style="font-size: 1.8rem; font-weight: bold; color: var(--primary);">
                                        {{ $match['home_score'] }} - {{ $match['away_score'] }}
                                    </div>
                                    <span style="font-size: 0.7rem; color: var(--text-muted);">
                                        @if ($match['result'] == 'win')
                                            <span style="color: #198754;"><i class="fas fa-check-circle"></i> Win</span>
                                        @elseif($match['result'] == 'draw')
                                            <span style="color: #ffc107;"><i class="fas fa-equals"></i> Draw</span>
                                        @else
                                            <span style="color: #dc3545;"><i class="fas fa-times-circle"></i> Loss</span>
                                        @endif
                                    </span>
                                @elseif ($match['status'] == 'live')
                                    <div style="font-size: 1.8rem; font-weight: bold; color: var(--primary);">
                                        {{ $match['home_score'] }} - {{ $match['away_score'] }}
                                    </div>
                                    <span style="font-size: 0.7rem; color: var(--primary);">live</span>
                                @else
                                    <div style="font-size: 1.5rem; color: white; font-weight: bold;">VS</div>
                                    <span style="font-size: 0.7rem; color: var(--primary);">Upcoming</span>
                                @endif
                            </div>

                            <div style="text-align: center; min-width: 80px;">
                                <div style="font-size: 2rem;">{{ $match['away_logo'] }}</div>
                                <p style="color: white; font-size: 0.8rem; margin-top: 0.25rem;">{{ $match['away_team'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Match Info --}}
                        <div style="flex: 1; min-width: 150px;">
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                <span
                                    style="background: rgba(139,0,0,0.2); color: var(--primary); padding: 2px 10px; border-radius: 12px; font-size: 0.75rem;">
                                    <i class="fas fa-trophy"></i> {{ $match['competition'] }}
                                </span>
                                @if (isset($match['round']))
                                    <span
                                        style="background: rgba(139,0,0,0.1); color: var(--text-muted); padding: 2px 10px; border-radius: 12px; font-size: 0.75rem;">
                                        {{ $match['round'] }}
                                    </span>
                                @endif
                            </div>
                            <div style="margin-top: 0.5rem; color: var(--text-muted); font-size: 0.85rem;">
                                <i class="fas fa-calendar-alt"></i> {{ date('M d, Y', strtotime($match['match_date'])) }}
                                <span style="margin-left: 1rem;"><i class="fas fa-clock"></i> {{ $match['time'] }}</span>
                            </div>
                            @if (isset($match['stadium']))
                                <div style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.25rem;">
                                    <i class="fas fa-map-marker-alt"></i> {{ $match['stadium'] }}
                                </div>
                            @endif
                        </div>

                        {{-- Actions --}}
                        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                            <a href="{{ route('matches.show',$match->id) }}" class="btn-primary btn-sm"
                                style="padding: 6px 16px;">
                                <i class="fas fa-eye"></i> Details
                            </a>
                            @if ($match['status'] == 'upcoming' && isset($match['ticket_link']))
                                <a href="{{ $match['ticket_link'] }}" class="btn-outline btn-sm"
                                    style="padding: 6px 16px; border-color: #198754; color: #198754;">
                                    <i class="fas fa-ticket-alt"></i> Tickets
                                </a>
                            @endif
                            @auth
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'journalist')
                                    <a href="/admin/matches/{{ $match['id'] }}/edit" class="btn-outline btn-sm"
                                        style="padding: 6px 16px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="card" style="text-align: center; padding: 3rem;">
                    <i class="fas fa-futbol" style="font-size: 3rem; color: var(--text-muted);"></i>
                    <p class="text-muted" style="margin-top: 1rem;">No matches found</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            <span class="active">1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>

    <style>
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            border-color: var(--primary) !important;
            color: var(--primary) !important;
            background: rgba(139, 0, 0, 0.1);
        }

        .match-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .match-item:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(139, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }

            .match-item {
                padding: 1rem !important;
            }

            .match-item>div {
                flex-direction: column;
                align-items: stretch !important;
                gap: 0.5rem !important;
            }

            .match-item>div>div {
                text-align: center !important;
            }
        }

        @media (max-width: 480px) {
            .grid-4 {
                grid-template-columns: 1fr 1fr;
            }

            .stat-card {
                padding: 0.75rem !important;
            }

            .stat-card p:first-child {
                font-size: 1.5rem !important;
            }
        }
    </style>

    <script>
        // Filter matches by tab
        function setFilter(filter, button) {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');

            // Filter matches
            const matchItems = document.querySelectorAll('.match-item');
            matchItems.forEach(item => {
                const status = item.dataset.status;
                if (filter === 'all') {
                    item.style.display = 'block';
                } else {
                    item.style.display = status === filter ? 'block' : 'none';
                }
            });
        }

        // Search matches
        function searchMatches() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const matchItems = document.querySelectorAll('.match-item');

            matchItems.forEach(item => {
                const searchData = item.dataset.search;
                if (searchTerm === '' || searchData.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Filter by competition (from dropdown)
        function filterMatches() {
            const competitionFilter = document.querySelector('select[onchange="filterMatches()"]:last-child').value;
            const matchItems = document.querySelectorAll('.match-item');

            matchItems.forEach(item => {
                const competition = item.dataset.competition;
                if (competitionFilter === 'all' || competition === competitionFilter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
@endsection
