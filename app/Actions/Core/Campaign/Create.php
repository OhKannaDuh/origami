<?php

namespace App\Actions\Core\Campaign;

use App\Http\Requests\Campaign\CreateRequest;
use App\Models\Core\Campaign;
use App\Models\User;
use App\Repositories\Core\CampaignRepositoryInterface;
use Ramsey\Uuid\Uuid;

final class Create implements CreateInterface
{


    public function __construct(
        private CampaignRepositoryInterface $campaigns,
    ) {
    }


    public function execute(array $context = []): Campaign
    {
        $request = $context['request'] ?? null;
        assert($request instanceof CreateRequest);

        $user = $request->user();
        assert($user instanceof User);

        $campaign = $this->campaigns->create([
            'uuid' => Uuid::uuid6(),
            'name' => $request->name(),
            'user_id' => $user->getKey(),
        ]);

        assert($campaign instanceof Campaign);
        $campaign->users()->attach($user);

        return $campaign;
    }
}
