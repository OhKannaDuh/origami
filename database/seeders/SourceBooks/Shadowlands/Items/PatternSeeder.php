<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\PatternData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class PatternSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Kakita Pattern',
            4,
            (new Cost()),
            (new PatternData())
                ->withDeadliness(1)
                ->withCost(3)
                ->withForWeapon()
        );

        $this->create(
            'Kenzo Blade',
            4,
            (new Cost()),
            (new PatternData())
                ->withDeadliness(1)
                ->withDamage(-1)
                ->withCost(5)
                ->withForWeapon()
        );

        $this->create(
            'Shirogane Jade Inlay',
            2,
            (new Cost()),
            (new PatternData())
                ->withDeadliness(-1)
                ->withCost(3)
                ->withForWeapon()
                ->withForArmor()
        );

        $this->create(
            'Uchedma\'s Technique',
            3,
            (new Cost()),
            (new PatternData())
                # ToDo: remove Cumbersome quality
                ->withPhysicalResistance(-1)
                ->withCost(4)
                ->withForArmor()
        );

        $this->create(
            'Yasunori  Steel',
            4,
            (new Cost()),
            (new PatternData())
                # ToDo: remove ceremonial, cumbersome, resplendent qualities
                # ToDo: add durable quality or +1 deadliness
                ->withCost(5)
                ->withForArmor()
        );
    }
}
