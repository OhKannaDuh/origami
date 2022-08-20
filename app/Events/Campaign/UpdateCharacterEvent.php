<?php

namespace App\Events\Campaign;

use App\Models\Character\Character;
use App\Models\Core\Campaign;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

final class UpdateCharacterEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;

    private Campaign $campaign;

    public Character $character;


    public function __construct(Campaign $campaign, Character $character)
    {
        $this->campaign = $campaign;
        $this->character = $character;
    }


    public function broadcastAs(): string
    {
        return 'campaign.character.update';
    }


    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('campaign.' . $this->campaign->uuid);
    }


    public function broadcastWith(): array
    {
        return [
            'character' => $this->character->toArray(),
        ];
    }
}
