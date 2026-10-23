@extends('layouts.app')

@section('title', 'FC Legend - User Profile')

@push('styles')
<style>
    .profile-cover {
        height: 160px;
        border-radius: 1rem 1rem 0 0;
        background:
            radial-gradient(circle at 20% 20%, rgba(220, 53, 69, .55), transparent 55%),
            radial-gradient(circle at 80% 80%, rgba(13, 110, 253, .35), transparent 55%),
            #1a1d21;
    }
    .profile-card { border-radius: 1rem; overflow: hidden; }
    .profile-avatar {
        width: 110px; height: 110px;
        margin-top: -55px;
        border: 5px solid #212529;
        background: linear-gradient(135deg, #dc3545, #a71d2a);
        font-size: 2.8rem; font-weight: 700;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .45);
    }
    .stat-box {
        background: rgba(255, 255, 255, .04);
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: .85rem;
        transition: transform .2s, border-color .2s;
    }
    .stat-box:hover { transform: translateY(-3px); border-color: #dc3545; }
    .stat-icon {
        width: 44px; height: 44px;
        background: rgba(220, 53, 69, .15);
        color: #dc3545;
    }
    .article-item {
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: .75rem;
        transition: background .2s, border-color .2s;
    }
    .article-item:hover { background: rgba(255, 255, 255, .04); border-color: #dc3545; }
</style>
@endpush

@section('content')
@auth
    @php
        $user    = Auth::user();
        $roles   = $user->getRoleNames();
        $canPost = $user->hasAnyRole(['admin', 'journalist']);
        $articles = $articles ?? collect(); // مرر $articles من الـ controller
    @endphp

    <div class="container py-5 my-4">
        <div class="row">
            <div class="col-lg-9 col-xl-8 mx-auto">

                {{-- Flash message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Header card --}}
                <div class="card bg-dark text-white border-secondary profile-card mb-4">
                    <div class="profile-cover"></div>

                    <div class="card-body px-4 pb-4 pt-0">
                        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3">
                            <div class="profile-avatar rounded-circle d-flex align-items-center justify-content-center text-white">
                                {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('edit.profile') }}" class="btn btn-info btn-sm px-3">
                                    <i class="fas fa-user-edit me-1"></i> Edit Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                                        <i class="fas fa-sign-out-alt me-1"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="mt-3">
                            <h2 class="heading-font fs-2 mb-1">{{ $user->name }}</h2>
                            <p class="text-secondary mb-2">
                                <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                            </p>
                            @forelse ($roles as $role)
                                <span class="badge bg-danger text-uppercase px-3 py-2 me-1">
                                    <i class="fas fa-user-shield me-1"></i>{{ $role }}
                                </span>
                            @empty
                                <span class="badge bg-secondary text-uppercase px-3 py-2">
                                    <i class="fas fa-user me-1"></i>User
                                </span>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <div class="stat-box p-3 d-flex align-items-center gap-3 text-white">
                            <div class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div>
                                <div class="fs-4 fw-bold lh-1">{{ $articles->count() }}</div>
                                <small class="text-secondary">Articles</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="stat-box p-3 d-flex align-items-center gap-3 text-white">
                            <div class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <div class="fs-6 fw-bold lh-1">{{ $user->created_at->format('M Y') }}</div>
                                <small class="text-secondary">Member since</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="stat-box p-3 d-flex align-items-center gap-3 text-white">
                            <div class="stat-icon rounded-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <div class="fs-6 fw-bold lh-1 text-capitalize">
                                    {{ $roles->first() ?? 'User' }}
                                </div>
                                <small class="text-secondary">Role</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Articles --}}
                <div class="card bg-dark text-white border-secondary profile-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="heading-font fs-3 mb-0">
                            <i class="fas fa-newspaper me-2 text-danger"></i> My Published Articles
                        </h4>
                        @if ($canPost)
                            <a href="" class="btn btn-danger btn-sm">
                                <i class="fas fa-plus me-1"></i> New Article
                            </a>
                        @endif
                    </div>

                    @if (!$canPost)
                        <div class="text-center py-4">
                            <i class="fas fa-lock fa-2x text-secondary mb-3"></i>
                            <p class="text-secondary mb-0">
                                Only journalists and administrators can post articles.
                            </p>
                        </div>
                    @elseif ($articles->isEmpty())
                        <div class="text-center py-4">
                            <i class="far fa-folder-open fa-2x text-secondary mb-3"></i>
                            <p class="text-secondary mb-0">You haven't published any articles yet.</p>
                        </div>
                    @else
                        <div class="d-flex flex-column gap-2">
                            @foreach ($articles as $article)
                                <a href="{{ route('news.show', $article) }}"
                                   class="article-item d-flex justify-content-between align-items-center p-3 text-decoration-none text-white">
                                    <div>
                                        <div class="fw-semibold">{{ $article->title }}</div>
                                        <small class="text-secondary">
                                            <i class="far fa-clock me-1"></i>{{ $article->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <i class="fas fa-chevron-right text-secondary"></i>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@else
    <script>window.location.href = "{{ route('login') }}";</script>
@endauth
@endsection
