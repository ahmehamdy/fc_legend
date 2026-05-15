{{-- resources/views/player-show.blade.php --}}
@extends('layouts.app')

@section('title', $player['name'] . ' - Player Profile')

@section('content')
    <div class="container" style="padding: 3rem 0;">
        <div class="d-flex justify-between align-center mb-4" style="flex-wrap: wrap; gap: 1rem;">
            <div class="d-flex gap-2" style="font-size: 0.9rem;">
                <a href="/" class="text-primary">Home</a>
                <span class="text-muted">/</span>
                <a href="/players" class="text-primary">Players</a>
                <span class="text-muted">/</span>
                <span class="text-muted">{{ $player['name'] }}</span>
            </div>

            {{-- Action Buttons (Admin only) --}}
            @auth
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'journalist')
                @endif
            @endauth
        </div>
        <div class="d-flex justify-between align-center mb-4">
            <a href="{{route('admin.players.edit', $player['id']) }}" class="btn-outline" style="padding: 8px 20px;">
                <i class="fas fa-edit"></i> Edit Player
            </a>
            <button onclick="openDeleteModal()" class="btn-outline"
                style="border-color: #dc3545; color: #dc3545; padding: 8px 20px;">
                <i class="fas fa-trash-alt"></i> Delete Player
            </button>
        </div>

        <div class="grid-2" style="gap: 2.5rem;">
            <div>
                <div class="card" style="overflow: hidden;">
                    <div style="position: relative;">
                        <img src="{{ asset('storage/' . ($player['image'] ?? 'players/default.png')) }}"
                            alt="{{ $player['name'] }}" style="width: 100%; height: 450px; object-fit: cover;">
                        <div style="position: absolute; top: 20px; right: 20px;">
                            @include('components.badge', ['type' => $player['status']])
                        </div>
                        <div
                            style="position: absolute; bottom: 20px; left: 20px; background: rgba(0,0,0,0.8); padding: 8px 20px; border-radius: 30px;">
                            <span class="text-primary"
                                style="font-size: 1.5rem; font-weight: bold;">#{{ $player['number'] }}</span>
                        </div>
                    </div>

                    <div style="padding: 1.5rem; background: var(--dark-card); border-top: 1px solid var(--dark-border);">
                        <div class="grid-3" style="gap: 1rem;">
                            <div class="text-center">
                                <i class="fas fa-futbol text-primary" style="font-size: 1.5rem;"></i>
                                <p class="text-muted small mt-1">Position</p>
                                <h4 style="color: white; font-size: 1.1rem;">{{ $player['position'] }}</h4>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-flag text-primary" style="font-size: 1.5rem;"></i>
                                <p class="text-muted small mt-1">Nationality</p>
                                <h4 style="color: white; font-size: 1.1rem;">{{ $player['nationality'] }}</h4>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-birthday-cake text-primary" style="font-size: 1.5rem;"></i>
                                <p class="text-muted small mt-1">Age</p>
                                <h4 style="color: white; font-size: 1.1rem;">{{ $player['age'] }} years</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="card" style="padding: 2rem;">
                    <h1 class="heading-font" style="font-size: 3rem; color: white; margin-bottom: 0.5rem;">
                        {{ $player['name'] }}</h1>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
                        <span
                            style="background: rgba(139,0,0,0.2); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;">
                            <i class="fas fa-trophy"></i> {{ $player['position'] }}
                        </span>
                        <span
                            style="background: rgba(139,0,0,0.2); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;">
                            <i class="fas fa-calendar-alt"></i> Signed: {{ $player['joined'] ?? '2022' }}
                        </span>
                        @if (isset($player['contract_until']))
                            <span
                                style="background: rgba(139,0,0,0.2); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;">
                                <i class="fas fa-file-signature"></i> Until: {{ $player['contract_until'] }}
                            </span>
                        @endif
                    </div>

                    <div style="margin-bottom: 2rem;">
                        <h3 class="heading-font" style="font-size: 1.5rem; color: white; margin-bottom: 1rem;">Biography
                        </h3>
                        <p class="text-muted" style="line-height: 1.8;">{{ $player['bio'] }}</p>
                    </div>

                    @if (isset($player['height']) || isset($player['weight']))
                        <div style="margin-bottom: 2rem;">
                            <h3 class="heading-font" style="font-size: 1.5rem; color: white; margin-bottom: 1rem;">Physical
                                Stats</h3>
                            <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                                @if (isset($player['height']))
                                    <div>
                                        <p class="text-muted small">Height</p>
                                        <p class="text-white" style="font-size: 1.2rem; font-weight: bold;">
                                            {{ $player['height'] }} cm</p>
                                        <div
                                            style="width: 100%; height: 4px; background: var(--dark-border); border-radius: 2px; margin-top: 0.5rem;">
                                            <div
                                                style="width: {{ min(100, ($player['height'] / 200) * 100) }}%; height: 100%; background: var(--primary); border-radius: 2px;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($player['weight']))
                                    <div>
                                        <p class="text-muted small">Weight</p>
                                        <p class="text-white" style="font-size: 1.2rem; font-weight: bold;">
                                            {{ $player['weight'] }} kg</p>
                                        <div
                                            style="width: 100%; height: 4px; background: var(--dark-border); border-radius: 2px; margin-top: 0.5rem;">
                                            <div
                                                style="width: {{ min(100, ($player['weight'] / 100) * 100) }}%; height: 100%; background: var(--primary); border-radius: 2px;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (isset($player['foot']))
                                    <div>
                                        <p class="text-muted small">Preferred Foot</p>
                                        <p class="text-white" style="font-size: 1.2rem; font-weight: bold;">
                                            {{ $player['foot'] }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div style="margin-bottom: 2rem;">
                        <h3 class="heading-font" style="font-size: 1.5rem; color: white; margin-bottom: 1rem;">Career
                            Statistics</h3>
                        <div class="grid-4" style="gap: 1rem;">
                            <div class="card" style="text-align: center; padding: 1rem;">
                                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                                    {{ $player['stats']['apps'] ?? 0 }}</p>
                                <p class="text-muted small">Appearances</p>
                            </div>
                            <div class="card" style="text-align: center; padding: 1rem;">
                                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                                    {{ $player['stats']['goals'] ?? 0 }}</p>
                                <p class="text-muted small">Goals</p>
                            </div>
                            <div class="card" style="text-align: center; padding: 1rem;">
                                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                                    {{ $player['stats']['assists'] ?? 0 }}</p>
                                <p class="text-muted small">Assists</p>
                            </div>
                            <div class="card" style="text-align: center; padding: 1rem;">
                                <p class="text-primary" style="font-size: 2rem; font-weight: bold; margin-bottom: 0;">
                                    {{ $player['stats']['yellow_cards'] ?? 0 }}</p>
                                <p class="text-muted small">Yellow Cards</p>
                            </div>
                        </div>
                    </div>

                    @if (isset($player['season_stats']) && count($player['season_stats']) > 0)
                        <div style="margin-bottom: 2rem;">
                            <h3 class="heading-font" style="font-size: 1.5rem; color: white; margin-bottom: 1rem;">Season
                                by Season</h3>
                            <div class="table-responsive">
                                <table class="data-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Season</th>
                                            <th>League</th>
                                            <th>Apps</th>
                                            <th>Goals</th>
                                            <th>Assists</th>
                                            <th>Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($player['season_stats'] as $season)
                                            <tr>
                                                <td>{{ $season['season'] }}</td>
                                                <td>{{ $season['league'] }}</td>
                                                <td>{{ $season['apps'] }}</td>
                                                <td><strong class="text-primary">{{ $season['goals'] }}</strong></td>
                                                <td>{{ $season['assists'] }}</td>
                                                <td>{{ $season['rating'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if (isset($player['achievements']) && count($player['achievements']) > 0)
                        <div>
                            <h3 class="heading-font" style="font-size: 1.5rem; color: white; margin-bottom: 1rem;">Honors
                                & Achievements</h3>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem;">
                                @foreach ($player['achievements'] as $achievement)
                                    <span
                                        style="background: rgba(139,0,0,0.15); border: 1px solid rgba(139,0,0,0.3); padding: 6px 14px; border-radius: 30px; font-size: 0.85rem;">
                                        <i class="fas fa-medal text-primary"></i> {{ $achievement }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if (isset($similarPlayers) && count($similarPlayers) > 0)
            <div style="margin-top: 3rem;">
                <h2 class="section-title">Similar Players</h2>
                <div class="grid-4">
                    @foreach ($similarPlayers as $similar)
                        <div class="card player-card" style="text-align: center;">
                            <img src="{{ $similar['image'] }}" alt="{{ $similar['name'] }}"
                                style="width: 100%; height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h3 style="font-size: 1.3rem; color: white;">{{ $similar['name'] }}</h3>
                                <p class="text-primary">{{ $similar['position'] }}</p>
                                <a href="/player/{{ $similar['id'] }}" class="btn-outline btn-sm d-inline-block">View
                                    Profile</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('admin.players') }}" class="btn-outline" style="padding: 12px 30px;">
                <i class="fas fa-arrow-left"></i> Back to All Players
            </a>
        </div>
    </div>

    <div id="deleteModal" class="modal" aria-modal="true" role="dialog" aria-describedby="deleteModalDesc">
        <div class="modal-content" style="max-width: 450px;">
            <div class="modal-header">
                <h3 class="heading-font" style="font-size: 1.8rem; color: var(--primary);">Delete Player</h3>
                <button onclick="closeDeleteModal()"
                    style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <p id="deleteModalDesc" class="mb-3" style="font-size: 1.1rem;">
                    Are you sure you want to delete <strong class="text-primary">{{ $player['name'] }}</strong>?
                </p>
                <p class="text-muted" style="font-size: 0.9rem;">This action cannot be undone. All player data will be
                    permanently removed.</p>

                <div
                    style="background: rgba(220, 53, 69, 0.1); border-left: 3px solid #dc3545; padding: 1rem; margin-top: 1rem; border-radius: 4px;">
                    <i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i>
                    <span class="text-muted" style="margin-left: 0.5rem;">Player ID: #{{ $player['id'] }} • Number
                        #{{ $player['number'] }}</span>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="closeDeleteModal()" class="btn-outline" style="padding: 10px 25px;">Cancel</button>
                <form id="deleteForm" method="POST" action="{{route('admin.players.delete' ,$player['id']) }}"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-primary" style="background-color: #dc3545; border-color: #dc3545;">
                        <i class="fas fa-trash-alt"></i> Yes, Delete Player
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .grid-4 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .progress-bar {
            transition: width 0.5s ease;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background-color: var(--dark-card);
            border-radius: 8px;
            width: 90%;
            max-width: 450px;
            animation: slideUp 0.3s ease;
            border: 1px solid var(--dark-border);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--dark-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--dark-border);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .grid-4 {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }
    </style>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
@endsection
