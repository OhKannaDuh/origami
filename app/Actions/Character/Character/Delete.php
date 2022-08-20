<?php

namespace App\Actions\Character\Character;

use App\Models\Character\Character;

final class Delete implements DeleteInterface
{


    public function execute(array $context = []): bool|null
    {
        $character = $context['character'] ?? null;
        assert($character instanceof Character);

        return $character->delete();
    }
}
