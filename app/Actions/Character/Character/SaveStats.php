<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Api\Character\SaveStatsRequest;

final class SaveStats implements SaveStatsInterface
{


    public function execute(array $context = []): int
    {
        $request = $context['request'] ?? null;
        assert($request instanceof SaveStatsRequest);

        $request->character()->update([
            'stats' => $request->stats(),
        ]);

        return $request->sendUpdate();
    }
}
