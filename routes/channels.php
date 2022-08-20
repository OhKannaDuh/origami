<?php

use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('campaign.{campaign}', function (User $current, Campaign $campaign) {
    foreach ($campaign->users as $user) {
        if ($user->is($current)) {
            return true;
        }
    }

    return false;
});
