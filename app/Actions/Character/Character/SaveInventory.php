<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Api\Character\SaveInventoryRequest;

final class SaveInventory implements SaveInventoryInterface
{


    public function execute(array $context = []): bool
    {
        $request = $context['request'] ?? null;
        assert($request instanceof SaveInventoryRequest);

        return $request->character()->update([
            'inventory' => [
                'containers' => $request->containers(),
            ],
        ]);
    }
}
