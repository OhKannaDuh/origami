<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Api\Character\SaveDisadvantagesRequest;

final class SaveDisadvantages implements SaveDisadvantagesInterface
{


    public function execute(array $context = []): int
    {
        $request = $context['request'] ?? null;
        assert($request instanceof SaveDisadvantagesRequest);

        $character = $request->character();
        $character->disadvantages()->attach($request->added());
        return $character->disadvantages()->detach($request->removed());
    }
}
