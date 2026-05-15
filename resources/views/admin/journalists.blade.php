{{-- resources/views/admin/journalists.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Journalists')

@section('content')
<div class="admin-layout">
    <div class="admin-sidebar">
        <h3 class="heading-font">Admin Panel</h3>
        <ul style="list-style: none;">
            <li><a href="/admin" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/admin/players" class="nav-link"><i class="fas fa-users"></i> Players</a></li>
            <li><a href="/admin/news" class="nav-link"><i class="fas fa-newspaper"></i> News</a></li>
            <li><a href="/admin/matches" class="nav-link"><i class="fas fa-calendar-alt"></i> Matches</a></li>
            <li><a href="/admin/users" class="nav-link"><i class="fas fa-user-shield"></i> Manage Admins</a></li>
            <li><a href="/admin/journalists" class="nav-link active"><i class="fas fa-pen-fancy"></i> Journalists</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <div class="d-flex justify-between align-center mb-4">
            <h1 class="heading-font" style="font-size: 2.5rem;">Journalists</h1>
            <button class="btn-primary" onclick="openModal('addJournalistModal')">+ Create Journalist</button>
        </div>

        @php
            $headers = ['Photo', 'Name', 'Email', 'Articles Written', 'Status', 'Actions'];
            $rows = [
                ['<img src="https://randomuser.me/api/portraits/women/68.jpg" width="40" style="border-radius: 50%;">', 'Sarah Williams', 'sarah@fcdynamo.com', '24', '<span class="badge-active">Active</span>', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
                ['<img src="https://randomuser.me/api/portraits/men/52.jpg" width="40" style="border-radius: 50%;">', 'David Chen', 'david@fcdynamo.com', '18', '<span class="badge-active">Active</span>', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
                ['<img src="https://randomuser.me/api/portraits/women/33.jpg" width="40" style="border-radius: 50%;">', 'Maria Garcia', 'maria@fcdynamo.com', '12', '<span style="background: #6c757d; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem;">Inactive</span>', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
            ];
        @endphp

        @include('components.table', ['headers' => $headers, 'rows' => $rows, 'paginate' => true])
    </div>
</div>

{{-- Add Journalist Modal --}}
<div id="addJournalistModal" class="modal" aria-modal="true" role="dialog" aria-describedby="addJournalistDesc">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="heading-font" style="font-size: 1.8rem;">Create Journalist Account</h3>
            <button onclick="closeModal('addJournalistModal')" style="background: none; border: none; color: white; font-size: 1.5rem;">&times;</button>
        </div>
        <div class="modal-body">
            <p id="addJournalistDesc" class="text-muted mb-3">Journalists can create and manage news articles.</p>
            <form>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label>Specialization</label>
                    <select class="form-control">
                        <option>General News</option>
                        <option>Match Reports</option>
                        <option>Transfer News</option>
                        <option>Academy News</option>
                    </select>
                </div>
                <div class="d-flex align-center gap-2">
                    <input type="checkbox" id="activeStatus">
                    <label for="activeStatus" class="text-muted">Active (can publish immediately)</label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('addJournalistModal')" style="background: #6c757d; border: none; padding: 8px 20px; color: white;">Cancel</button>
            <button class="btn-primary">Create Journalist</button>
        </div>
    </div>
</div>
@endsection
