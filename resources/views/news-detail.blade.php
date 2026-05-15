{{-- resources/views/news-detail.blade.php --}}
@extends('layouts.app')

@section('title', 'News Article')

@section('content')
@php
    $article = [
        'title'=>'Dynamo announces state-of-the-art training complex',
        'date'=>'2025-03-28',
        'author'=>'Club Editor',
        'category'=>'Club News',
        'content'=>'<p class="lead">We are proud to unveil plans for a €50m training facility that will set new standards in player development.</p>
        <p>The complex will feature 12 pitches, hydrotherapy pools, sports science labs, and accommodation for 60 academy players.</p>
        <p>"This investment shows our commitment to excellence," said club president. "We want to provide our players with the best facilities in the country."</p>
        <p>Construction is set to begin in June 2025, with completion expected by summer 2026.</p>',
        'images'=>[
            'https://images.unsplash.com/photo-1577223625816-7546f13df25d?w=800',
            'https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=800',
            'https://images.unsplash.com/photo-1522778119026-d647f0596c86?w=800'
        ]
    ];
@endphp
<div class="container" style="padding: 5rem 0; max-width: 900px;">
    <div class="d-flex gap-2 mb-3">
        <a href="/" class="text-primary">Home</a> /
        <a href="/news" class="text-primary">News</a> /
        <span class="text-muted">Article</span>
    </div>

    <h1 style="font-size: 3rem; color: white;">{{ $article['title'] }}</h1>
    <div class="d-flex gap-3 text-muted mt-2 mb-4">
        <span><i class="far fa-calendar-alt"></i> {{ date('F d, Y', strtotime($article['date'])) }}</span>
        <span><i class="far fa-user"></i> By {{ $article['author'] }}</span>
        <span><i class="far fa-folder"></i> {{ $article['category'] }}</span>
    </div>

    <div class="card" style="padding: 2rem;">
        {!! $article['content'] !!}
    </div>

    <h3 class="heading-font text-white mt-4 mb-3">Image Gallery</h3>
    <div class="grid-3">
        @foreach($article['images'] as $img)
            <img src="{{ $img }}" style="width: 100%; border-radius: 8px;">
        @endforeach
    </div>

    <div class="mt-4 pt-3" style="border-top: 1px solid var(--dark-border);">
        <div class="d-flex gap-2">
            <span class="text-muted">Share:</span>
            <a href="#" class="text-primary"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-primary"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
</div>
@endsection
