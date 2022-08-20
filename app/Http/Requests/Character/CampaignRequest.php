<?php

namespace App\Http\Requests\Character;

use App\Models\Core\Campaign;
use App\Models\User;

final class CampaignRequest extends CharacterRequest
{


    public function authorize(): bool
    {
        $user = $this->user();
        assert($user instanceof User);

        return parent::authorize() && $this->campaign()->users->contains($user);
    }


    private function campaign(): Campaign
    {
        $campaign = $this->route('campaign');
        assert($campaign instanceof Campaign);

        return $campaign;
    }
}
