<?php

namespace App\Http\Requests\Api\Character;

use App\Models\Character\Disadvantage;
use App\Validation\Rules;
use Illuminate\Support\Arr;

final class SaveDisadvantagesRequest extends SaveRequest
{


    public function rules(): array
    {
        return [
            'character.disadvantages' => (new Rules())
            ->required()
            ->array(),
            'character.disadvantages.*.id' => (new Rules())
            ->required()
            ->exists(Disadvantage::class),
        ];
    }


    private function disadvantages(): array
    {
        $array = Arr::get($this->all(), 'character.disadvantages');
        assert(is_array($array));

        return $array;
    }


    public function added(): array
    {
        $payloadTechniqueIds = array_column($this->disadvantages(), 'id');
        $currentTechniqueIds = array_column($this->character()->disadvantages->toArray(), 'id');

        return Arr::flatten(array_diff($payloadTechniqueIds, $currentTechniqueIds));
    }


    public function removed(): array
    {
        $payloadTechniqueIds = array_column($this->disadvantages(), 'id');
        $currentTechniqueIds = array_column($this->character()->disadvantages->toArray(), 'id');

        return Arr::flatten(array_diff($currentTechniqueIds, $payloadTechniqueIds));
    }
}
