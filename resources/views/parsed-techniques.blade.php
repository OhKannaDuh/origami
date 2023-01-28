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
        <hr />
    </div>
@endforeach
