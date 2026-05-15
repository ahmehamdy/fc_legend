{{-- resources/views/admin/players-edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Player')

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
                <h1 class="heading-font" style="font-size: 2.5rem;">Edit Player</h1>
                <a href="{{ url()->previous() }}" class="btn-outline">← Back to Player</a>
            </div>

            @if ($errors->any())
                <div style="color:red;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="card" style="padding: 2rem; max-width: 800px;">
                <form method="POST" action="{{ route('admin.players.update', $player) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid-2" style="gap: 1.5rem;">
                        <div class="form-group" style="grid-column: span 2;">
                            <div class="d-flex align-center gap-3" style="margin-bottom: 1rem;">
                                @if (isset($player['image']))
                                    <img src="{{ asset('storage/' . $player->image) }}"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid var(--primary);">
                                @endif
                                <div>
                                    <label>Current Photo</label>
                                    <input type="file" name="image" class="form-control">
                                    <small class="text-muted">Leave empty to keep current photo</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Full Name <span class="text-primary">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $player['name'] }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Position <span class="text-primary">*</span></label>
                            <select name="position" class="form-control" required>
                                <option value="Goalkeeper" {{ $player['position'] == 'Goalkeeper' ? 'selected' : '' }}>
                                    Goalkeeper</option>
                                <option value="Defender" {{ $player['position'] == 'Defender' ? 'selected' : '' }}>Defender
                                </option>
                                <option value="Midfielder" {{ $player['position'] == 'Midfielder' ? 'selected' : '' }}>
                                    Midfielder</option>
                                <option value="Forward" {{ $player['position'] == 'Forward' ? 'selected' : '' }}>Forward
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jersey Number <span class="text-primary">*</span></label>
                            <input type="number" name="number" class="form-control" value="{{ $player['number'] }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control"
                                value="{{ $player['nationality'] }}">
                        </div>

                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" value="{{ $player['age'] }}">
                        </div>

                        <div class="form-group">
                            <label>Status <span class="text-primary">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $player['status'] == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="injured" {{ $player['status'] == 'injured' ? 'selected' : '' }}>Injured
                                </option>
                                <option value="suspended" {{ $player['status'] == 'suspended' ? 'selected' : '' }}>
                                    Suspended</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Height (cm)</label>
                            <input type="number" name="height" class="form-control" value="{{ $player['height'] }}">
                        </div>

                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input type="number" name="weight" class="form-control" value="{{ $player['weight'] }}">
                        </div>

                        <div class="form-group" style="grid-column: span 2;">
                            <label>Biography</label>
                            <textarea name="bio" rows="4" class="form-control" placeholder="Player biography...">{{ $player['bio'] }}</textarea>
                        </div>
                        {{--
                    <div class="form-group">
                        <label>Goals (this season)</label>
                        <input type="number" name="goals" class="form-control" value="{{ $player['goals'] }}">
                    </div>

                    <div class="form-group">
                        <label>Assists (this season)</label>
                        <input type="number" name="assists" class="form-control" value="{{ $player['assists'] }}">
                    </div>

                    <div class="form-group">
                        <label>Appearances</label>
                        <input type="number" name="appearances" class="form-control" value="{{ $player['appearances'] }}">
                    </div>

                    <div class="form-group">
                        <label>Contract Until</label>
                        <input type="date" name="contract_until" class="form-control" value="{{ $player['contract_until'] }}">
                    </div>
                </div> --}}

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn-primary">Update Player</button>
                            <a href="/admin/players" class="btn-outline">Cancel</a>
                            <button type="button" class="btn-outline"
                                style="border-color: #dc3545; color: #dc3545; margin-left: auto;"
                                onclick="confirmDelete()">Delete Player</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Are you sure you want to delete this player? This action cannot be undone.')) {
                // Submit delete form
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/players/{{ $player['id'] }}';
                form.innerHTML = '@csrf @method('DELETE')';
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
