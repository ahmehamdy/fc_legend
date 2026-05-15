{{-- resources/views/admin/news.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage News')

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
                    <a href="/admin/players" class="nav-link">
                        <i class="fas fa-users"></i> Players
                    </a>
                </li>

                <li>
                    <a href="/admin/news" class="nav-link active">
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
                    Manage News
                </h1>

                <button class="btn-primary" onclick="openModal('addNewsModal')">
                    + Add Article
                </button>
            </div>

            <div class="table-responsive">
                <table class="data-table">

                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            {{-- <th>Date</th> --}}
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($news as $item)
                            <tr>

                                <td>
                                    <img src="{{ $item->image }}" width="50" height="40"
                                        style="object-fit: cover; border-radius: 4px;">
                                </td>

                                <td>
                                    {{ $item->title }}
                                </td>

                                {{-- <td>
                                    {{ $item->created_at->format('Y-m-d') }}
                                </td> --}}

                                <td>
                                    {{ $item->author }}
                                </td>

                                <td>

                                    <button class="btn-outline btn-sm">
                                        Edit
                                    </button>

                                    <button class="btn-outline btn-sm" style="border-color: #dc3545; color: #dc3545;">
                                        Delete
                                    </button>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted" style="padding: 2rem;">
                                    No data available
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="pagination">
                @if ($news->onFirstPage())
                    <span>Prev</span>
                @else
                    <a href="{{ $news->previousPageUrl() }}">Prev</a>
                @endif

                @for ($i = 1; $i <= $news->lastPage(); $i++)
                    <a href="{{ $news->url($i) }}" class="{{ $news->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor

                @if ($news->hasMorePages())
                    <a href="{{ $news->nextPageUrl() }}">Next</a>
                @else
                    <span>Next</span>
                @endif
            </div>

        </div>
    </div>

    @include('components.modal', [
        'id' => 'addNewsModal',
        'title' => 'Add News Article',
    ])
@endsection
