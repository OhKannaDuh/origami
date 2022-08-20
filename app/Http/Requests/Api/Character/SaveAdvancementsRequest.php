<?php

namespace App\Http\Requests\Api\Character;

use App\Models\Character\Technique;
use App\Validation\Rules;
use Illuminate\Support\Arr;

final class SaveAdvancementsRequest extends SaveRequest
{


    public function rules(): array
    {
        return [
            'character.advancements' => (new Rules())
                ->required()
                ->array(),
            'character.school_rank' => (new Rules())
                ->required()
                ->integer(),
            'character.stats' => (new Rules())
                ->required()
                ->array(),
            'character.techniques' => (new Rules())
                ->required()
                ->array(),
            'character.techniques.*.id' => (new Rules())
                ->required()
                ->exists(Technique::class),
        ];
    }


    public function advancements(): array
    {
        $array = Arr::get($this->all(), 'character.advancements');
        assert(is_array($array));

        return $array;
    }


    public function schoolRank(): int
    {
        $int = Arr::get($this->all(), 'character.school_rank');
        assert(is_int($int));

        return $int;
    }


    public function stats(): array
    {
        $array = Arr::get($this->all(), 'character.stats');
        assert(is_array($array));

        return $array;
    }


    public function techniques(): array
    {
        $array = Arr::get($this->all(), 'character.techniques');
        assert(is_array($array));

        return $array;
    }
}
