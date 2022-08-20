<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Api\Character\SaveAdvantagesRequest;

final class SaveAdvantages implements SaveAdvantagesInterface
{


    public function execute(array $context = []): int
    {
        $request = $context['request'] ?? null;
        assert($request instanceof SaveAdvantagesRequest);

        $character = $request->character();
        $character->advantages()->attach($request->added());
        return $character->advantages()->detach($request->removed());
    }
}
