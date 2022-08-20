<?php

namespace App\Http\Requests\Api\Character;

use App\Events\Campaign\UpdateCharacterEvent;
use App\Http\Requests\Request;
use App\Models\Character\Character;
use App\Repositories\Character\CharacterRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SaveRequest extends Request
{


    private function getCharacterRepository(): CharacterRepositoryInterface
    {
        $repository = App::make(CharacterRepositoryInterface::class);
        assert($repository instanceof CharacterRepositoryInterface);
        return $repository;
    }


    public function authorize(): bool
    {
        if (!$this->has('character.id')) {
            return false;
        }

        return $this->character()->user->is($this->user());
    }


    public function character(): Character
    {
        $id = Arr::get($this->all(), 'character.id');
        assert(is_int($id));

        $character = $this->getCharacterRepository()->getById($id);
        assert($character instanceof Character);

        return $character;
    }


    public function sendUpdate(): int
    {
        $count = 0;
        $character = $this->character();
        foreach ($character->campaigns as $campaign) {
            $count++;
            UpdateCharacterEvent::dispatch($campaign, $character);
        }

        return $count;
    }
}
