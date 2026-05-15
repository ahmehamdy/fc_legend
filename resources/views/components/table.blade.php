{{-- resources/views/components/table.blade.php --}}
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" class="text-center text-muted" style="padding: 2rem;">No data
                        available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination">
    @if ($players->onFirstPage())
        <span>Prev</span>
    @else
        <a href="{{ $players->previousPageUrl() }}">Prev</a>
    @endif

    @for ($i = 1; $i <= $players->lastPage(); $i++)
        <a href="{{ $players->url($i) }}" class="{{ $players->currentPage() == $i ? 'active' : '' }}">
            {{ $i }}
        </a>
    @endfor

    @if ($players->hasMorePages())
        <a href="{{ $players->nextPageUrl() }}">Next</a>
    @else
        <span>Next</span>
    @endif
</div>
