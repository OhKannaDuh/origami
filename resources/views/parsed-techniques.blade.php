@foreach ($techniques as $technique)
    <div>
        <p>{{ $technique['key'] }}</p>
        @if ($technique['activation'])
            {!! $technique['activation'] !!}
        @endif
        @if ($technique['effect'])
            {!! $technique['effect'] !!}
        @endif
        @if ($technique['opportunities'])
            <p>New Opportunities</p>
            <ul>
                @foreach ($technique['opportunities'] as $opportunity)
                    <li><strong>{{ $opportunity['cost'] }}:</strong> {{ $opportunity['effect'] }}</li>
                @endforeach
            </ul>
        @endif
        @if ($technique['magnitudes'])
            <p>Magnitude</p>
            <ul>
                @foreach ($technique['magnitudes'] as $magnitude)
                    <li><strong>Magnitude {{ $magnitude['cost'] }}:</strong> {{ $magnitude['effect'] }}</li>
                @endforeach
            </ul>
        @endif
        <hr />
    </div>
@endforeach
