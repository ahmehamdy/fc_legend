{{-- resources/views/matches.blade.php --}}
@extends('layouts.app')

@section('title', 'Fixtures & Results')

@section('content')
<div class="container" style="padding: 5rem 0;">
    <h1 style="font-size: 4rem; color: white;">Fixtures & Results</h1>

    <div class="d-flex gap-3 mt-4 mb-4" style="border-bottom: 1px solid var(--dark-border);">
        <a href="#" class="text-primary" style="padding-bottom: 10px; border-bottom: 2px solid var(--primary);">Upcoming</a>
        <a href="#" class="text-muted" style="padding-bottom: 10px;">Previous</a>
    </div>

    @php
        $matches = [
            ['opponent'=>'City FC','date'=>'2025-04-05','time'=>'15:00','result'=>null,'league'=>'Premier League','home'=>true,'ticket_status'=>'available'],
            ['opponent'=>'United Stars','date'=>'2025-04-12','time'=>'17:30','result'=>null,'league'=>'Premier League','home'=>false,'ticket_status'=>'soon'],
            ['opponent'=>'Rovers AFC','date'=>'2025-04-19','time'=>'20:00','result'=>null,'league'=>'Cup Quarterfinal','home'=>true,'ticket_status'=>'available'],
            ['opponent'=>'Athletic Madrid','date'=>'2025-03-29','time'=>'20:00','result'=>'3-1','league'=>'Cup','home'=>true,'attendance'=>'48,234'],
            ['opponent'=>'North London FC','date'=>'2025-03-22','time'=>'14:00','result'=>'0-0','league'=>'Premier League','home'=>false,'attendance'=>'62,000'],
            ['opponent'=>'Manchester City','date'=>'2025-03-15','time'=>'16:30','result'=>'2-1','league'=>'Premier League','home'=>true,'attendance'=>'51,892'],
        ];
    @endphp

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Competition</th>
                    <th>Opponent</th>
                    <th>Time / Result</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matches as $match)
                    <tr>
                        <td>{{ date('M d, Y', strtotime($match['date'])) }}</td>
                        <td>{{ $match['league'] }}</td>
                        <td>
                            @if($match['home'])
                                <span style="background: var(--primary); padding: 2px 8px; border-radius: 4px; font-size: 0.7rem;">HOME</span> vs {{ $match['opponent'] }}
                            @else
                                <span style="background: #6c757d; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem;">AWAY</span> @ {{ $match['opponent'] }}
                            @endif
                        </td>
                        <td>
                            @if($match['result'])
                                <strong style="color: white;">{{ $match['result'] }}</strong>
                            @else
                                {{ $match['time'] }}
                            @endif
                        </td>
                        <td>
                            @if($match['result'])
                                <span style="color: #198754;">✓ Finished</span>
                            @else
                                @if($match['ticket_status'] == 'available')
                                    <button class="btn-primary btn-sm">Buy Tickets</button>
                                @else
                                    <span class="text-muted">Tickets Soon</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
