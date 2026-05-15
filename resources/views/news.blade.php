{{-- resources/views/news.blade.php --}}
@extends('layouts.app')

@section('title', 'Latest Club News')

@section('content')
<div class="container" style="padding: 5rem 0;">
    <div class="d-flex justify-between align-center flex-wrap">
        <h1 style="font-size: 4rem; color: white;">Latest News</h1>
        <div class="d-flex gap-2">
            <input type="text" class="form-control" placeholder="Search news..." style="width: 250px;">
            <button class="btn-primary" style="padding: 12px 20px;"><i class="fas fa-search"></i></button>
        </div>
    </div>

    @php
        $newsItems = [
            ['id'=>1,'title'=>'Dynamo signs Brazilian striker on record deal','date'=>'2025-03-28','image'=>'https://images.unsplash.com/photo-1574623452334-1e0ac2b3ccb4?w=800','excerpt'=>'Club record signing for €50 million...'],
            ['id'=>2,'title'=>'Academy graduate signs professional contract','date'=>'2025-03-25','image'=>'https://images.unsplash.com/photo-1517466787929-bc90951d0974?w=800','excerpt'=>'Local talent shines after impressive performances...'],
            ['id'=>3,'title'=>'New stadium experience announced','date'=>'2025-03-22','image'=>'https://images.unsplash.com/photo-1522778119026-d647f0596c86?w=800','excerpt'=>'Enhanced fan zones and VIP areas coming soon...'],
            ['id'=>4,'title'=>'Seven players receive international call-ups','date'=>'2025-03-18','image'=>'https://images.unsplash.com/photo-1551958219-acbc608c6377?w=800','excerpt'=>'National team duties for upcoming friendlies...'],
            ['id'=>5,'title'=>'Charity match raises €100k for local hospital','date'=>'2025-03-15','image'=>'https://images.unsplash.com/photo-1577223625816-7546f13df25d?w=800','excerpt'=>'Community initiative a huge success...'],
            ['id'=>6,'title'=>'New kit launch for 2025/26 season','date'=>'2025-03-10','image'=>'https://images.unsplash.com/photo-1551958219-acbc608c6377?w=800','excerpt'=>'Classic design with modern twist revealed...'],
        ];
    @endphp

    <div class="grid-3 mt-4">
        @foreach($newsItems as $item)
            <div class="card news-card">
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
                <div class="card-body">
                    <span class="news-date"><i class="far fa-calendar-alt"></i> {{ date('M d, Y', strtotime($item['date'])) }}</span>
                    <h3 style="color: white; font-family: \'Bebas Neue\', cursive; font-size: 1.3rem;">{{ $item['title'] }}</h3>
                    <p class="text-muted mt-1">{{ Str::limit($item['excerpt'], 80) }}</p>
                    <a href="/news-detail/{{ $item['id'] }}" class="btn-outline btn-sm mt-2 d-inline-block">Read More →</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        <span class="active">1</span>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">Next →</a>
    </div>
</div>
@endsection
