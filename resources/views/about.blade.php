{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About FC Dynamo')

@section('content')
<div class="container" style="padding: 5rem 0;">
    <div class="text-center mb-4">
        <h1 style="font-size: 4rem; color: white;">Club History</h1>
        <div style="width: 80px; height: 3px; background: var(--primary); margin: 1rem auto;"></div>
    </div>

    <div class="grid-2">
        <div class="card" style="padding: 2rem;">
            <p class="lead" style="font-size: 1.2rem;">Founded in 1923 by a group of steelworkers, FC Dynamo rose from industrial roots to become a symbol of resilience and excellence.</p>
            <p class="mt-3 text-muted">With 12 league championships and 7 domestic cups, the club has defined an era of attacking football. The golden age of the 1960s saw Dynamo win three consecutive titles, led by legendary striker Ferenc Puskás.</p>
            <div style="background: #000; padding: 1.5rem; margin-top: 1.5rem; border-right: 4px solid var(--primary);">
                <p style="font-style: italic;">"Never walk alone, for the red and black runs in our veins." — Club Motto</p>
            </div>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c86?w=800" style="width: 100%; border-radius: 8px;" alt="Historic stadium">
        </div>
    </div>

    <div class="grid-2 mt-4">
        <div class="card" style="padding: 2rem; text-align: center;">
            <i class="fas fa-bullseye" style="font-size: 3rem; color: var(--primary);"></i>
            <h2 class="heading-font" style="font-size: 2rem; margin-top: 1rem;">Mission</h2>
            <p class="text-muted">To inspire communities through attacking football, develop homegrown talents, and compete at the highest level with integrity and passion.</p>
        </div>
        <div class="card" style="padding: 2rem; text-align: center;">
            <i class="fas fa-eye" style="font-size: 3rem; color: var(--primary);"></i>
            <h2 class="heading-font" style="font-size: 2rem; margin-top: 1rem;">Vision</h2>
            <p class="text-muted">To become a global benchmark for sustainable football excellence, blending tradition with innovation.</p>
        </div>
    </div>

    <div class="mt-4">
        <h2 class="section-title">The Cathedral of Football</h2>
        <div class="card" style="padding: 2rem;">
            <div class="grid-2">
                <div>
                    <p><strong class="text-primary">Name:</strong> Dynamo Arena</p>
                    <p><strong class="text-primary">Capacity:</strong> 52,000 spectators</p>
                    <p><strong class="text-primary">Opened:</strong> 1954 (renovated 2012)</p>
                    <p><strong class="text-primary">Record Attendance:</strong> 51,892 vs United City (2023)</p>
                </div>
                <div style="background: #000; padding: 1rem; text-align: center; border-radius: 8px;">
                    <i class="fas fa-map-marker-alt text-primary" style="font-size: 2rem;"></i>
                    <p>Champions Boulevard, Downtown</p>
                    <p class="text-muted small">🚆 Metro: Dynamo Station • 🅿️ 3,000 parking spaces</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
