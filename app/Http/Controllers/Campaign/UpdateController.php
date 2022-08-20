<?php

namespace App\Http\Controllers\Campaign;

use App\Actions\Core\Campaign\UpdateInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CampaignRequest;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Models\Character\Character;
use App\Models\Core\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class UpdateController extends Controller
{


    protected function update(UpdateRequest $request, Campaign $campaign, UpdateInterface $action): RedirectResponse
    {
        $this->message('Campaign information updated.');

        $campaign = $action->execute([
            'campaign' => $campaign,
            'request' => $request,
        ]);

        return Redirect::route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]);
    }


    protected function add(CampaignRequest $request, Campaign $campaign, Character $character): RedirectResponse
    {
        $this->message($character->name . ' was added.');

        $campaign->characters()->attach($character);

        return Redirect::route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]);
    }


    protected function remove(CampaignRequest $request, Campaign $campaign, Character $character): RedirectResponse
    {
        $this->message($character->name . ' was removed.');

        $campaign->characters()->detach($character);

        return Redirect::route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]);
    }
}
