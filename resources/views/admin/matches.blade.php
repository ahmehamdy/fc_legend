{{-- resources/views/admin/matches.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Matches')

@section('content')
<div class="admin-layout">
    <div class="admin-sidebar">
        <h3 class="heading-font">Admin Panel</h3>
        <ul style="list-style: none;">
            <li><a href="/admin" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/admin/players" class="nav-link"><i class="fas fa-users"></i> Players</a></li>
            <li><a href="/admin/news" class="nav-link"><i class="fas fa-newspaper"></i> News</a></li>
            <li><a href="/admin/matches" class="nav-link active"><i class="fas fa-calendar-alt"></i> Matches</a></li>
            <li><a href="/admin/users" class="nav-link"><i class="fas fa-user-shield"></i> Manage Admins</a></li>
            <li><a href="/admin/journalists" class="nav-link"><i class="fas fa-pen-fancy"></i> Journalists</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <div class="d-flex justify-between align-center mb-4">
            <h1 class="heading-font" style="font-size: 2.5rem;">Manage Matches</h1>
            <button class="btn-primary" onclick="openModal('addMatchModal')">+ Add Match</button>
        </div>

        @php
            $headers = ['Opponent', 'Date', 'Time', 'Competition', 'Result', 'Actions'];
            $rows = [
                ['City FC', '2025-04-05', '15:00', 'Premier League', '-', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
                ['United Stars', '2025-04-12', '17:30', 'Premier League', '-', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
                ['Rovers AFC', '2025-03-29', '20:00', 'Cup', '3-1', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
            ];
        @endphp

        @include('components.table', ['headers' => $headers, 'rows' => $rows, 'paginate' => true])
    </div>
</div>

@include('components.modal', ['id' => 'addMatchModal', 'title' => 'Add New Match'])
@endsection
