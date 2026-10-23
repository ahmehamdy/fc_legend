@extends('layouts.app')

@section('title', 'FC Legend - Player Detail')
@section('page', 'player-detail')

@section('content')
<div class="container py-5 my-4">
    <div id="player-detail-container" data-player-id="{{ $player }}">
        <x-spinner message="Loading player details..." />
    </div>
</div>
@endsection
