<p>{{ $start }}</p><br />
@foreach ($items as $item)
    <p><strong>{{ $item['cost'] }}:</strong> {{ $item['effect'] }}</p>
@endforeach
