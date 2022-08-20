<?php

namespace App\Http\Requests\Campaign;

class OwnerRequest extends CampaignRequest
{


    public function authorize(): bool
    {
        return parent::authorize() && $this->campaign()->user_id === $this->user()?->getKey();
    }
}
