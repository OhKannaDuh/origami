(new Curriculum())
@foreach ($curriculum as $rank => $data)
                ->withRank({{ $rank }}, (new CurriculumRank())
    @foreach ($data as $datum)
        @if ($datum['type'] === 'skill_group')
        ->withSkillGroup('{{ $datum['key'] }}')
        @elseif ($datum['type'] === 'skill')
->withSkill('{{ $datum['key'] }}')
        @elseif ($datum['type'] === 'technique_type')
->withTechniqueType('{{ $datum['key'] }}', {{ $datum['min'] }}, {{ $datum['max'] }})
        @elseif ($datum['type'] === 'technique_subtype')
->withTechniqueSubtype('{{ $datum['key'] }}', {{ $datum['min'] }}, {{ $datum['max'] }})
        @elseif ($datum['type'] === 'technique' && !$datum['ignore_requirements'])
->withTechnique('{{ $datum['key'] }}')
        @elseif ($datum['type'] === 'technique' && $datum['ignore_requirements'])
->withTechnique('{{ $datum['key'] }}', true)
        @endif
    @endforeach
)
@endforeach
,

