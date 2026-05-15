{{-- resources/views/components/modal.blade.php --}}
<div id="{{ $id }}" class="modal" aria-modal="true" role="dialog" aria-describedby="{{ $id }}Desc">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="heading-font" style="font-size: 1.8rem;">{{ $title }}</h3>
            <button onclick="closeModal('{{ $id }}')"
                style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div class="modal-body">
            <p id="{{ $id }}Desc" class="text-muted mb-3">Fill in the details below.</p>
            <form method="POST" action="{{ route('admin.players.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" placeholder="Enter age">
                </div>
                <div class="form-group">
                    <label>Position / Role</label>
                    <select class="form-control" name="position">
                        <option value="GoalKeeper">GoalKeeper</option>
                        <option value="Defender">Defender</option>
                        <option value="Midfielder">Midfielder</option>
                        <option value="Forward">Forward</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="injured">Injured</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Player Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

        </div>
        <div class="modal-footer">
            <button onclick="closeModal('{{ $id }}')"
                style="background: #6c757d; border: none; padding: 8px 20px; color: white; cursor: pointer;">Cancel</button>
            <button class="btn-primary">Save Changes</button>
        </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }
</script>
