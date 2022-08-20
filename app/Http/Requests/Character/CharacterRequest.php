<?php

namespace App\Http\Requests\Character;

use App\Http\Requests\AuthRequest;
use App\Models\Character\Character;
use App\Models\User;

class CharacterRequest extends AuthRequest
{


    public function authorize(): bool
    {
        $user = $this->user();
        assert($user instanceof User);

        return parent::authorize() && $this->character()->user->is($user);
    }


    private function character(): Character
    {
        $character = $this->route('character');
        assert($character instanceof Character);

        return $character;
    }
}
