<?php

namespace App\Http\Requests\Api\Character;

use App\Models\Character\Advantage;
use App\Validation\Rules;
use Illuminate\Support\Arr;

final class SaveAdvantagesRequest extends SaveRequest
{


    public function rules(): array
    {
        return [
            'character.advantages' => (new Rules())
                ->required()
                ->array(),
            'character.advantages.*.id' => (new Rules())
                ->required()
                ->exists(Advantage::class),
        ];
    }


    private function advantages(): array
    {
        $array = Arr::get($this->all(), 'character.advantages');
        assert(is_array($array));

        return $array;
    }


    public function added(): array
    {
        $payloadTechniqueIds = array_column($this->advantages(), 'id');
        $currentTechniqueIds = array_column($this->character()->advantages->toArray(), 'id');

        return Arr::flatten(array_diff($payloadTechniqueIds, $currentTechniqueIds));
    }


    public function removed(): array
    {
        $payloadTechniqueIds = array_column($this->advantages(), 'id');
        $currentTechniqueIds = array_column($this->character()->advantages->toArray(), 'id');

        return Arr::flatten(array_diff($currentTechniqueIds, $payloadTechniqueIds));
    }
}
