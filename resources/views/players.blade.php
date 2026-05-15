{{-- resources/views/players.blade.php --}}
@extends('layouts.app')

@section('title', 'First Team Squad')

@section('content')
<div class="container" style="padding: 5rem 0;">
    <div class="d-flex justify-between align-center flex-wrap">
        <h1 style="font-size: 4rem; color: white;">First Team</h1>
        <select class="form-control" style="width: auto;">
            <option>All Positions</option>
            <option>Goalkeepers</option>
            <option>Defenders</option>
            <option>Midfielders</option>
            <option>Forwards</option>
        </select>
    </div>

    @php
        $players = [
            ['id'=>1,'name'=>'A. Becker','position'=>'Goalkeeper','number'=>1,'nationality'=>'Germany','age'=>31,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/32.jpg'],
            ['id'=>2,'name'=>'K. Walker','position'=>'Defender','number'=>2,'nationality'=>'England','age'=>33,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/45.jpg'],
            ['id'=>3,'name'=>'R. Dias','position'=>'Defender','number'=>3,'nationality'=>'Portugal','age'=>26,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/22.jpg'],
            ['id'=>4,'name'=>'J. Stones','position'=>'Defender','number'=>5,'nationality'=>'England','age'=>29,'status'=>'injured','image'=>'https://randomuser.me/api/portraits/men/67.jpg'],
            ['id'=>5,'name'=>'Rodri','position'=>'Midfielder','number'=>16,'nationality'=>'Spain','age'=>27,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/52.jpg'],
            ['id'=>6,'name'=>'K. De Bruyne','position'=>'Midfielder','number'=>17,'nationality'=>'Belgium','age'=>32,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/88.jpg'],
            ['id'=>7,'name'=>'P. Foden','position'=>'Midfielder','number'=>47,'nationality'=>'England','age'=>23,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/29.jpg'],
            ['id'=>8,'name'=>'E. Haaland','position'=>'Forward','number'=>9,'nationality'=>'Norway','age'=>23,'status'=>'active','image'=>'https://randomuser.me/api/portraits/men/15.jpg'],
        ];
    @endphp

    <div class="grid-4 mt-4">
        @foreach($players as $player)
            <div class="card player-card">
                <div style="position: relative;">
                    <img src="{{ $player['image'] }}" alt="{{ $player['name'] }}">
                    <div style="position: absolute; top: 10px; right: 10px;">
                        @include('components.badge', ['type' => $player['status']])
                    </div>
                    <div style="position: absolute; bottom: 10px; left: 10px; background: black; padding: 4px 8px; border-radius: 4px;">
                        <span class="text-primary">#{{ $player['number'] }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <h3>{{ $player['name'] }}</h3>
                    <p class="text-primary">{{ $player['position'] }}</p>
                    <p class="text-muted small">{{ $player['nationality'] }} • Age {{ $player['age'] }}</p>
                    <a href="/player/{{ $player['id'] }}" class="btn-outline btn-sm mt-2 d-inline-block">Profile</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
