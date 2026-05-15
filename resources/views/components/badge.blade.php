{{-- resources/views/components/badge.blade.php --}}
@php
    $badgeClass = match($type ?? 'active') {
        'active' => 'badge-active',
        'injured' => 'badge-injured',
        'suspended' => 'badge-suspended',
        default => 'badge-active',
    };
@endphp
<span class="{{ $badgeClass }}">{{ ucfirst($type ?? 'Active') }}</span>
