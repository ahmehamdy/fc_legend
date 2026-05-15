{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container" style="padding: 5rem 0;">
    <div class="grid-2">
        <div>
            <h1 style="font-size: 4rem; color: white;">Get in Touch</h1>
            <div class="card" style="padding: 2rem; margin-top: 1rem;">
                <div class="d-flex align-center gap-3 mb-3">
                    <i class="fas fa-map-marker-alt text-primary" style="font-size: 1.5rem;"></i>
                    <span>Dynamo Arena, Champions Boulevard, Downtown</span>
                </div>
                <div class="d-flex align-center gap-3 mb-3">
                    <i class="fas fa-phone text-primary" style="font-size: 1.5rem;"></i>
                    <span>+1 (555) 123-4567</span>
                </div>
                <div class="d-flex align-center gap-3 mb-3">
                    <i class="fas fa-envelope text-primary" style="font-size: 1.5rem;"></i>
                    <span>info@fcdynamo.com</span>
                </div>
                <div class="d-flex align-center gap-3">
                    <i class="fas fa-clock text-primary" style="font-size: 1.5rem;"></i>
                    <span>Mon-Fri: 9AM - 6PM</span>
                </div>
            </div>
            <div class="card" style="padding: 2rem; text-align: center; margin-top: 1rem;">
                <i class="fas fa-map" style="font-size: 3rem; color: var(--primary);"></i>
                <p class="text-muted mt-2">📍 Map Placeholder - Interactive Stadium Map</p>
            </div>
        </div>
        <div class="card" style="padding: 2rem;">
            <h2 class="heading-font" style="font-size: 2rem;">Send us a Message</h2>
            @include('components.form', ['type' => 'contact'])
        </div>
    </div>
</div>
@endsection
