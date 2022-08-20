<?php

namespace App\Actions\Core\Campaign;

use App\Http\Requests\Campaign\UpdateRequest;
use App\Models\Core\Campaign;

final class Update implements UpdateInterface
{


    public function execute(array $context = []): Campaign
    {
        $request = $context['request'] ?? null;
        assert($request instanceof UpdateRequest);

        $campaign = $context['campaign'] ?? null;
        assert($campaign instanceof Campaign);

        $campaign->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return $campaign;
    }
}
