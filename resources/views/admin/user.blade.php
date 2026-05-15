{{-- resources/views/admin/users.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Administrators')

@section('content')
<div class="admin-layout">
    <div class="admin-sidebar">
        <h3 class="heading-font">Admin Panel</h3>
        <ul style="list-style: none;">
            <li><a href="/admin" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/admin/players" class="nav-link"><i class="fas fa-users"></i> Players</a></li>
            <li><a href="/admin/news" class="nav-link"><i class="fas fa-newspaper"></i> News</a></li>
            <li><a href="/admin/matches" class="nav-link"><i class="fas fa-calendar-alt"></i> Matches</a></li>
            <li><a href="/admin/users" class="nav-link active"><i class="fas fa-user-shield"></i> Manage Admins</a></li>
            <li><a href="/admin/journalists" class="nav-link"><i class="fas fa-pen-fancy"></i> Journalists</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <div class="d-flex justify-between align-center mb-4">
            <h1 class="heading-font" style="font-size: 2.5rem;">Administrators</h1>
            <button class="btn-primary" onclick="openModal('addAdminModal')">+ Add Admin</button>
        </div>

        @php
            $headers = ['Name', 'Email', 'Role', 'Created At', 'Actions'];
            $rows = [
                ['John Doe', 'john@fcdynamo.com', '<span style="background: var(--primary); padding: 2px 8px; border-radius: 4px;">Super Admin</span>', '2024-01-15', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
                ['Jane Smith', 'jane@fcdynamo.com', '<span style="background: #6c757d; padding: 2px 8px; border-radius: 4px;">Admin</span>', '2024-06-20', '<button class="btn-outline btn-sm">Edit</button> <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">Delete</button>'],
            ];
        @endphp

        @include('components.table', ['headers' => $headers, 'rows' => $rows, 'paginate' => true])
    </div>
</div>

{{-- Add Admin Modal --}}
<div id="addAdminModal" class="modal" aria-modal="true" role="dialog" aria-describedby="addAdminDesc">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="heading-font" style="font-size: 1.8rem;">Add New Administrator</h3>
            <button onclick="closeModal('addAdminModal')" style="background: none; border: none; color: white; font-size: 1.5rem;">&times;</button>
        </div>
        <div class="modal-body">
            <p id="addAdminDesc" class="text-muted mb-3">Create a new admin account with full access.</p>
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
                    <label>Role</label>
                    <select class="form-control">
                        <option>Admin</option>
                        <option>Super Admin</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('addAdminModal')" style="background: #6c757d; border: none; padding: 8px 20px; color: white;">Cancel</button>
            <button class="btn-primary">Create Admin</button>
        </div>
    </div>
</div>
@endsection
