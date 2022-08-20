<?php

namespace App\Http\Requests\Api\Character;

use App\Validation\Rules;
use Illuminate\Support\Arr;

final class SaveStatsRequest extends SaveRequest
{


    public function rules(): array
    {
        return [
            'character.stats' => (new Rules())
                ->required()
                ->array(),
            'character.stats.rings.air' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.rings.earth' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.rings.fire' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.rings.void' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.rings.water' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.social.honor' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.social.glory' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.social.status' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.conflict.strife' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.conflict.fatigue' => (new Rules())
                ->integer()
                ->required(),
            'character.stats.conflict.void_points' => (new Rules())
                ->integer()
                ->required(),
        ];
    }


    public function stats(): array
    {
        $array = Arr::get($this->all(), 'character.stats');
        assert(is_array($array));

        return $array;
    }
}
