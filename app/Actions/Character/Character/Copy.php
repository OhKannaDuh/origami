<?php

declare(strict_types=1);

namespace App\Actions\Character\Character;

use App\Models\Character\Character;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

final class Copy implements CopyInterface
{


    public function execute(array $context = []): Character
    {
        $character = $context['character'] ?? null;
        assert($character instanceof Character);

        $copy = $character->replicate();
        $copy->name = 'Copy of ' . $character->name;
        $copy->uuid = Uuid::uuid6()->toString();
        $copy->created_at = Carbon::now();
        $copy->save();

        return $copy;
    }
}
