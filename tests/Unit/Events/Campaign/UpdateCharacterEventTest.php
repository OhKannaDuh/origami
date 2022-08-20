<?php

namespace Tests\Unit\Events\Campaign;

use App\Events\Campaign\UpdateCharacterEvent;
use App\Models\Character\Character;
use App\Models\Core\Campaign;
use Tests\TestCase;

final class UpdateCharacterEventTest extends TestCase
{


    public function testEvent(): void
    {
        $campaign = Campaign::factory()->create();
        $character = Character::factory()->create();
        $campaign->characters()->attach($character);

        $event = new UpdateCharacterEvent($campaign, $character);

        self::assertSame('campaign.character.update', $event->broadcastAs());
        self::assertSame('private-campaign.' . $campaign->uuid, $event->broadcastOn()->name);
        self::assertSame(['character' => $character->toArray()], $event->broadcastWith());
    }
}
