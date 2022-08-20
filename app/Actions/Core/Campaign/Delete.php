<?php

namespace App\Actions\Core\Campaign;

use App\Models\Core\Campaign;

final class Delete implements DeleteInterface
{


    public function execute(array $context = []): bool|null
    {
        $campaign = $context['campaign'] ?? null;
        assert($campaign instanceof Campaign);

        return $campaign->delete();
    }
}
