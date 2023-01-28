@if ($start)
    <p>{{ $start }}</p>
@endif
<ul>
    @foreach ($items as $item)
        <li>
            <strong>{{ $item['title'] }}:</strong> {{ $item['description'] }}
        </li>
    @endforeach
</ul>
@if ($end)
    <p>{{ $end }}</p>
@endif
