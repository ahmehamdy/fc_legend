{{-- resources/views/admin/players-create.blade.php --}}
@extends('layouts.app')

@section('title', 'Add New Player')

@section('content')
    <div class="admin-layout">
        <div class="admin-sidebar">
            <h3 class="heading-font">Admin Panel</h3>
            <ul style="list-style: none;">
                <li><a href="/admin" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="/admin/players" class="nav-link active"><i class="fas fa-users"></i> Players</a></li>
                <li><a href="/admin/news" class="nav-link"><i class="fas fa-newspaper"></i> News</a></li>
                <li><a href="/admin/matches" class="nav-link"><i class="fas fa-calendar-alt"></i> Matches</a></li>
                <li><a href="/admin/users" class="nav-link"><i class="fas fa-user-shield"></i> Manage Admins</a></li>
                <li><a href="/admin/journalists" class="nav-link"><i class="fas fa-pen-fancy"></i> Journalists</a></li>
            </ul>
        </div>

        <div class="admin-content">
            <div class="d-flex justify-between align-center mb-4">
                <h1 class="heading-font" style="font-size: 2.5rem;">Add New Player</h1>
                <a href="/admin/players" class="btn-outline">← Back to Players</a>
            </div>

            @if ($errors->any())
                <div style="color:red;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="card" style="padding: 2rem; max-width: 800px;">
                <form method="POST" action="{{ route('admin.players.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid-2" style="gap: 1.5rem;">
                        <div class="form-group">
                            <label>Full Name <span class="text-primary">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter player name"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Position <span class="text-primary">*</span></label>
                            <select name="position" class="form-control" required>
                                <option value="">Select Position</option>
                                <option value="Goalkeeper">Goalkeeper</option>
                                <option value="Defender">Defender</option>
                                <option value="Midfielder">Midfielder</option>
                                <option value="Forward">Forward</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Number <span class="text-primary">*</span></label>
                            <input type="number" name="number" class="form-control" placeholder="e.g., 9" required>
                        </div>

                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" placeholder="e.g., Brazil">
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" placeholder="e.g., 25">
                        </div>

                        <div class="form-group">
                            <label>Status <span class="text-primary">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="injured">Injured</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Height (cm)</label>
                            <input type="text" name="height" class="form-control" placeholder="e.g., 185">
                        </div>

                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input type="text" name="weight" class="form-control" placeholder="e.g., 78">
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>Biography</label>
                            <textarea name="bio" rows="4" class="form-control"
                                placeholder="Player biography, achievements, playing style..."></textarea>
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>Player Photo</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Upload JPG, PNG or WEBP (max 2MB)</small>
                        </div>
                        {{--
                    <div class="form-group">
                        <label>Goals (this season)</label>
                        <input type="number" name="goals" class="form-control" value="0">
                    </div>

                    <div class="form-group">
                        <label>Assists (this season)</label>
                        <input type="number" name="assists" class="form-control" value="0">
                    </div>

                    <div class="form-group">
                        <label>Appearances</label>
                        <input type="number" name="appearances" class="form-control" value="0">
                    </div>

                    <div class="form-group">
                        <label>Contract Until</label>
                        <input type="date" name="contract_until" class="form-control">
                    </div> --}}
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn-primary">Save Player</button>
                        <a href="/admin/players" class="btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
