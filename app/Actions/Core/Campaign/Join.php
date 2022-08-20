<?php

namespace App\Actions\Core\Campaign;

use App\Enums\Core\Campaign\JoinResponse;
use App\Http\Requests\AuthRequest;
use App\Models\Core\Campaign;
use App\Models\User;

final class Join implements JoinInterface
{


    public function execute(array $context = []): JoinResponse
    {
        $request = $context['request'] ?? null;
        assert($request instanceof AuthRequest);

        $campaign = $context['campaign'] ?? null;
        assert($campaign instanceof Campaign);

        $user = $request->user();
        assert($user instanceof User);

        if ($campaign->users()->where('user_id', $user->getKey())->exists()) {
            return JoinResponse::ALREADY_A_MEMBER;
        }

        $campaign->users()->attach($user);

        return JoinResponse::JOINED;
    }
}
