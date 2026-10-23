@extends('layouts.app')

@section('title', 'Edit Profile - FC Legend')

@push('styles')
<style>
    .edit-card {
        border-radius: 1rem;
        overflow: hidden;
    }
    .edit-card .card-header-custom {
        background: rgba(255, 255, 255, .03);
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        padding: 1.1rem 1.5rem;
    }
    .section-icon {
        width: 40px; height: 40px;
        background: rgba(220, 53, 69, .15);
        color: #dc3545;
    }

    .edit-avatar {
        width: 72px; height: 72px;
        background: linear-gradient(135deg, #dc3545, #a71d2a);
        font-size: 1.9rem; font-weight: 700;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .45);
        border: 3px solid #212529;
    }

    .edit-card .form-control {
        background-color: rgba(255, 255, 255, .04);
        border-color: rgba(255, 255, 255, .15);
        color: #fff;
        padding: .7rem .9rem;
        border-radius: .6rem;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }
    .edit-card .form-control:focus {
        background-color: rgba(255, 255, 255, .06);
        border-color: #dc3545;
        box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .2);
        color: #fff;
    }
    .edit-card .form-control::placeholder { color: rgba(255, 255, 255, .3); }
    .edit-card .form-label {
        font-size: .85rem;
        font-weight: 600;
        color: rgba(255, 255, 255, .75);
        margin-bottom: .4rem;
    }

    .input-icon-wrap { position: relative; }
    .input-icon-wrap > i.lead-icon {
        position: absolute;
        left: .95rem; top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, .35);
        pointer-events: none;
    }
    .input-icon-wrap .form-control { padding-left: 2.6rem; }
    .input-icon-wrap.has-toggle .form-control { padding-right: 2.8rem; }

    .toggle-pass {
        position: absolute;
        right: .4rem; top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: 0;
        color: rgba(255, 255, 255, .5);
        width: 36px; height: 36px;
        border-radius: .5rem;
    }
    .toggle-pass:hover { color: #fff; background: rgba(255, 255, 255, .08); }

    .strength-bar {
        height: 5px;
        background: rgba(255, 255, 255, .1);
        border-radius: 5px;
        overflow: hidden;
    }
    .strength-bar > span {
        display: block;
        height: 100%;
        width: 0;
        border-radius: 5px;
        transition: width .3s, background .3s;
    }

    .action-bar {
        position: sticky;
        bottom: 1rem;
        z-index: 10;
        background: rgba(33, 37, 41, .92);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .5);
    }
</style>
@endpush

@section('content')
    @php $user = $user ?? Auth::user(); @endphp

    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                {{-- Header --}}
                <div class="mb-4">
                    <a href="{{ route('profile') }}" class="btn btn-outline-light btn-sm mb-4 rounded-pill px-3">
                        <i class="fas fa-arrow-left me-2"></i> Back to Profile
                    </a>

                    <div class="d-flex align-items-center gap-3">
                        <div class="edit-avatar rounded-circle d-flex align-items-center justify-content-center text-white">
                            {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h1 class="heading-font display-6 text-white mb-0">
                                Edit <span class="text-danger">Profile</span>
                            </h1>
                            <p class="text-secondary mb-0">
                                Update your personal information and account security.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="fw-semibold mb-1">
                            <i class="fas fa-exclamation-triangle me-2"></i>Please fix the following:
                        </div>
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('update.profile') }}" method="POST" id="editProfileForm" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Personal info --}}
                    <div class="card bg-dark text-white border-secondary edit-card mb-4">
                        <div class="card-header-custom d-flex align-items-center gap-3">
                            <div class="section-icon rounded-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h5 class="heading-font mb-0">Personal Information</h5>
                                <small class="text-secondary">Your name and email address</small>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-id-badge lead-icon"></i>
                                    <input type="text" id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $user->name) }}"
                                           required maxlength="255" autocomplete="name">
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-envelope lead-icon"></i>
                                    <input type="email" id="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $user->email) }}"
                                           required autocomplete="email">
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Security --}}
                    <div class="card bg-dark text-white border-secondary edit-card mb-4">
                        <div class="card-header-custom d-flex align-items-center gap-3">
                            <div class="section-icon rounded-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <h5 class="heading-font mb-0">Change Password</h5>
                                <small class="text-secondary">Leave empty to keep your current password</small>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <div class="input-icon-wrap has-toggle">
                                    <i class="fas fa-key lead-icon"></i>
                                    <input type="password" id="current_password" name="current_password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           autocomplete="current-password">
                                    <button type="button" class="toggle-pass" data-target="current_password"
                                            aria-label="Show or hide password">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <div class="input-icon-wrap has-toggle">
                                    <i class="fas fa-lock lead-icon"></i>
                                    <input type="password" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           autocomplete="new-password">
                                    <button type="button" class="toggle-pass" data-target="password"
                                            aria-label="Show or hide password">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                <div class="mt-2" id="strengthWrap" style="display:none;">
                                    <div class="strength-bar"><span id="strengthFill"></span></div>
                                    <small id="strengthText" class="text-secondary"></small>
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <div class="input-icon-wrap has-toggle">
                                    <i class="fas fa-check-double lead-icon"></i>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="form-control" autocomplete="new-password">
                                    <button type="button" class="toggle-pass" data-target="password_confirmation"
                                            aria-label="Show or hide password">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                <small id="matchText" class="d-block mt-1"></small>
                            </div>
                        </div>
                    </div>

                    {{-- Sticky actions --}}
                    <div class="action-bar p-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <small class="text-secondary d-none d-sm-block">
                            <i class="fas fa-shield-alt me-1"></i> Your changes are saved securely
                        </small>
                        <div class="d-flex gap-2 ms-sm-auto">
                            <a href="{{ route('profile') }}" class="btn btn-outline-light px-4">Cancel</a>
                            <button type="submit" class="btn btn-danger px-4" id="saveBtn">
                                <i class="fas fa-save me-2"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        // Show / hide password
        document.querySelectorAll('.toggle-pass').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.target);
                const icon  = btn.querySelector('i');
                const show  = input.type === 'password';
                input.type = show ? 'text' : 'password';
                icon.className = show ? 'far fa-eye-slash' : 'far fa-eye';
            });
        });

        // Password strength
        const pass      = document.getElementById('password');
        const confirm   = document.getElementById('password_confirmation');
        const wrap      = document.getElementById('strengthWrap');
        const fill      = document.getElementById('strengthFill');
        const text      = document.getElementById('strengthText');
        const matchText = document.getElementById('matchText');

        const levels = [
            { w: '20%',  c: '#dc3545', t: 'Very weak' },
            { w: '40%',  c: '#fd7e14', t: 'Weak' },
            { w: '60%',  c: '#ffc107', t: 'Fair' },
            { w: '80%',  c: '#20c997', t: 'Good' },
            { w: '100%', c: '#198754', t: 'Strong' },
        ];

        function score(v) {
            let s = 0;
            if (v.length >= 8) s++;
            if (v.length >= 12) s++;
            if (/[a-z]/.test(v) && /[A-Z]/.test(v)) s++;
            if (/\d/.test(v)) s++;
            if (/[^A-Za-z0-9]/.test(v)) s++;
            return Math.max(0, Math.min(s, 5) - 1);
        }

        function checkMatch() {
            if (!confirm.value) { matchText.textContent = ''; return; }
            const ok = pass.value === confirm.value;
            matchText.className = 'd-block mt-1 small ' + (ok ? 'text-success' : 'text-danger');
            matchText.innerHTML = ok
                ? '<i class="fas fa-check-circle me-1"></i>Passwords match'
                : '<i class="fas fa-times-circle me-1"></i>Passwords do not match';
        }

        pass.addEventListener('input', () => {
            if (!pass.value) { wrap.style.display = 'none'; checkMatch(); return; }
            const l = levels[score(pass.value)];
            wrap.style.display = 'block';
            fill.style.width = l.w;
            fill.style.background = l.c;
            text.textContent = l.t;
            text.style.color = l.c;
            checkMatch();
        });
        confirm.addEventListener('input', checkMatch);

        // Prevent double submit
        document.getElementById('editProfileForm').addEventListener('submit', function () {
            const btn = document.getElementById('saveBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
        });
    })();
</script>
@endpush
