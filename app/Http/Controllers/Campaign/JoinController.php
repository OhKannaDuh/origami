<?php

namespace App\Http\Controllers\Campaign;

use App\Actions\Core\Campaign\JoinInterface;
use App\Enums\Core\Campaign\JoinResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Core\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class JoinController extends Controller
{


    protected function join(AuthRequest $request, Campaign $campaign, JoinInterface $action): RedirectResponse
    {
        $response = $action->execute([
            'campaign' => $campaign,
            'request' => $request,
        ]);

        $message = match ($response) {
            JoinResponse::ALREADY_A_MEMBER => 'You were already in this campaign.',
            JoinResponse::JOINED => "You've joined '{$campaign->name}'.",
        };

        $this->message($message);

        return Redirect::route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]);
    }
}
