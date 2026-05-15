{{-- resources/views/legends.blade.php --}}
@extends('layouts.app')

@section('title', 'Hall of Fame - Legends')

@section('content')
<div class="container" style="padding: 5rem 0;">
    <div class="text-center mb-4">
        <h1 style="font-size: 4rem; color: white;">Hall of Fame</h1>
        <p class="text-muted">Honoring the icons who defined our legacy.</p>
        <div style="width: 80px; height: 3px; background: var(--primary); margin: 1rem auto;"></div>
    </div>

    @php
        $legends = [
            ['name'=>'Ferenc Puskás','era'=>'1950s','achievement'=>'382 goals in 354 apps','image'=>'https://randomuser.me/api/portraits/men/1.jpg','honor'=>'Golden Boot'],
            ['name'=>'Zoltán Czibor','era'=>'1950s-60s','achievement'=>'5 league titles','image'=>'https://randomuser.me/api/portraits/men/3.jpg','honor'=>'Legendary Winger'],
            ['name'=>'Flórián Albert','era'=>'1960s','achievement'=>'Ballon d\'Or 1967','image'=>'https://randomuser.me/api/portraits/men/5.jpg','honor'=>'European Golden Player'],
            ['name'=>'Sándor Kocsis','era'=>'1950s','achievement'=>'All-time top scorer','image'=>'https://randomuser.me/api/portraits/men/7.jpg','honor'=>'Golden Head'],
            ['name'=>'László Kubala','era'=>'1940s-50s','achievement'=>'Revolutionized tactics','image'=>'https://randomuser.me/api/portraits/men/9.jpg','honor'=>'Visionary'],
            ['name'=>'Gyula Grosics','era'=>'1950s','achievement'=>'The Black Panther','image'=>'https://randomuser.me/api/portraits/men/11.jpg','honor'=>'Legend GK'],
        ];
    @endphp

    <div class="grid-4">
        @foreach($legends as $legend)
            <div class="card" style="text-align: center; padding: 2rem;">
                <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem; border: 3px solid var(--primary);">
                    <img src="{{ $legend['image'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3 style="font-size: 1.8rem; color: white;">{{ $legend['name'] }}</h3>
                <p class="text-primary">{{ $legend['era'] }}</p>
                <p class="text-muted">{{ $legend['achievement'] }}</p>
                <span class="badge-active" style="background-color: var(--primary); margin-top: 0.5rem;">{{ $legend['honor'] }}</span>
            </div>
        @endforeach
    </div>
</div>
@endsection
