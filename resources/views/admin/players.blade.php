@extends('layouts.app')

@section('title', 'Manage Players')

@section('content')
    <div class="admin-layout">

        <div class="admin-sidebar">
            <h3 class="heading-font">Admin Panel</h3>

            <ul style="list-style: none;">

                <li>
                    <a href="/admin" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>

                <li>
                    <a href="/admin/players" class="nav-link active">
                        <i class="fas fa-users"></i> Players
                    </a>
                </li>

                <li>
                    <a href="/admin/news" class="nav-link">
                        <i class="fas fa-newspaper"></i> News
                    </a>
                </li>

                <li>
                    <a href="/admin/matches" class="nav-link">
                        <i class="fas fa-calendar-alt"></i> Matches
                    </a>
                </li>

                <li>
                    <a href="/admin/users" class="nav-link">
                        <i class="fas fa-user-shield"></i> Manage Admins
                    </a>
                </li>

                <li>
                    <a href="/admin/journalists" class="nav-link">
                        <i class="fas fa-pen-fancy"></i> Journalists
                    </a>
                </li>

            </ul>
        </div>

        <div class="admin-content">

            <div class="d-flex justify-between align-center mb-4">

                <h1 class="heading-font" style="font-size: 2.5rem;">
                    Manage Players
                </h1>

                <a href="{{ route('admin.players.create') }}" class="btn-primary">
                    + Add Player
                </a>

            </div>

            <div class="table-responsive">

                <table class="data-table">

                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($players as $player)
                            <tr>

                                <td>
                                    <img src="{{ asset('storage/' . ($player->image ?? 'players/default.png')) }}"
                                        width="40" height="40" style="border-radius: 50%; object-fit: cover;">
                                </td>

                                <td>
                                    {{ $player->name }}
                                </td>

                                <td>
                                    {{ $player->position ?? '-' }}
                                </td>

                                <td>
                                    {{ $player->number }}
                                </td>

                                <td>

                                    <span class="{{ $player->status == 'injured' ? 'badge-injured' : 'badge-active' }}">
                                        {{ $player->status }}
                                    </span>

                                </td>

                                <td>

                                    <a href="{{ route('admin.players.show', $player->id) }}" class="btn-outline btn-sm">
                                        Show
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted" style="padding: 2rem;">

                                    No data available

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="pagination">
                @if ($players->onFirstPage())
                    <span>Prev</span>
                @else
                    <a href="{{ $players->previousPageUrl() }}">Prev</a>
                @endif

                @for ($i = 1; $i <= $players->lastPage(); $i++)
                    <a href="{{ $players->url($i) }}" class="{{ $players->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

                @if ($players->hasMorePages())
                    <a href="{{ $players->nextPageUrl() }}">Next</a>
                @else
                    <span>Next</span>
                @endif
            </div>

        </div>

    </div>

    @include('components.modal', [
        'id' => 'addPlayerModal',
        'title' => 'Add New Player',
    ])
@endsection
