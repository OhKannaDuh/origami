<?php

namespace App\Http\Requests\Campaign;

use App\Http\Requests\AuthRequest;
use App\Models\Core\Campaign;
use App\Models\User;

class CampaignRequest extends AuthRequest
{


    public function authorize(): bool
    {
        $user = $this->user();
        assert($user instanceof User);

        return parent::authorize() && $this->campaign()->users->contains($user);
    }


    protected function campaign(): Campaign
    {
        $campaign = $this->route('campaign');
        assert($campaign instanceof Campaign);

        return $campaign;
    }
}
