            (new StartingTechniques())
@foreach($starting_techniques as $key => $data)
@if (array_key_exists('amount', $data))
                ->withChoice('{{ $key }}', {{ $data['amount'] }}, [
@else
                ->withGroup('{{ $key }}', [
@endif
@foreach($data['keys'] as $key)
                    '{{ $key }}',
@endforeach
                ])
@endforeach
,
