@props(['type' => 'active', 'text' => null])

@php
    $classes = [
        'active' => 'bg-success text-white',
        'injured' => 'bg-warning text-dark',
        'suspended' => 'bg-danger text-white',
        'upcoming' => 'bg-info text-dark',
        'live' => 'bg-danger text-white blink-pulse',
        'finished' => 'bg-secondary text-white',
        'win' => 'bg-success text-white',
        'loss' => 'bg-danger text-white',
        'draw' => 'bg-warning text-dark',
        'admin' => 'bg-danger text-white',
        'journalist' => 'bg-primary text-white',
    ][$type] ?? 'bg-secondary text-white';

    $label = $text ?? ucfirst($type);
@endphp

<span class="badge {{ $classes }} px-2 py-1 uppercase">{{ $label }}</span>
