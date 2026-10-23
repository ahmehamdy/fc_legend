@props(['message' => 'Loading...'])

<div {{ $attributes->merge(['class' => 'text-center py-5']) }}>
    <div class="spinner-border text-danger" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
    @if($message)
        <p class="text-muted mt-3 mb-0">{{ $message }}</p>
    @endif
</div>
