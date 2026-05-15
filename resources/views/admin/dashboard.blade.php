{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="admin-layout">
        <div class="admin-sidebar">
            <h3 class="heading-font">Admin Panel</h3>
            <ul style="list-style: none;">
                <li><a href="/admin" class="nav-link active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{route('admin.players')}}" class="nav-link"><i class="fas fa-users"></i> Players</a></li>
                <li><a href="/admin/news" class="nav-link"><i class="fas fa-newspaper"></i> News</a></li>
                <li><a href="/admin/matches" class="nav-link"><i class="fas fa-calendar-alt"></i> Matches</a></li>
                <li><a href="" class="nav-link"><i class="fas fa-user-shield"></i> Manage Admins</a></li>
                <li><a href="/admin/journalists" class="nav-link"><i class="fas fa-pen-fancy"></i> Journalists</a></li>
            </ul>
        </div>

        <div class="admin-content">
            <div class="d-flex justify-between align-center mb-4">
                <h1 class="heading-font" style="font-size: 2.5rem;">Dashboard</h1>
                <div class="text-muted">
                    <i class="fas fa-user-circle"></i> Welcome, Admin
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>{{$total_players}}</h3>
                    <p class="text-muted">Total Players</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-newspaper"></i>
                    <h3>{{$total_news}}</h3>
                    <p class="text-muted">News Articles</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>{{$total_fixtures}}</h3>
                    <p class="text-muted">Matches Played</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>{{$total_staff}}</h3>
                    <p class="text-muted">Staff Members</p>
                </div>
            </div>

            <div class="grid-4 mt-4">
                <a href="{{route('admin.players.create')}}" class="btn-primary text-center">+ Add Player</a>
                <a href="{{route('admin.news')}}" class="btn-primary text-center">+ Add News</a>
                <a href="/admin/matches/create" class="btn-primary text-center">+ Add Match</a>
                <a href="/admin/users/create" class="btn-outline text-center">+ Add Admin</a>
            </div>

            <div class="mt-4">
                <h3 class="heading-font text-white">Recent Activity</h3>
                <div class="card" style="padding: 1.5rem; margin-top: 1rem;">
                    <div style="border-bottom: 1px solid var(--dark-border); padding: 0.75rem 0;">
                        <i class="fas fa-user-plus text-primary"></i> New admin added: john@example.com
                        <span class="float-end text-muted small">2 hours ago</span>
                    </div>
                    <div style="border-bottom: 1px solid var(--dark-border); padding: 0.75rem 0;">
                        <i class="fas fa-edit text-primary"></i> News article updated: "New signing announced"
                        <span class="float-end text-muted small">Yesterday</span>
                    </div>
                    <div style="padding: 0.75rem 0;">
                        <i class="fas fa-futbol text-primary"></i> Match result updated: 3-1 win vs Rovers
                        <span class="float-end text-muted small">2 days ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
