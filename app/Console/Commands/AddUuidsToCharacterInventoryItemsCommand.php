<?php

namespace App\Console\Commands;

use App\Models\Character\Character;
use App\Repositories\Character\CharacterRepositoryInterface;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class AddUuidsToCharacterInventoryItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:inventory:uuid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds uuids to Character inventory items';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CharacterRepositoryInterface $characters)
    {
        foreach ($characters->bypassCache()->all() as $character) {
            assert($character instanceof Character);

            $inventory = $character->inventory;
            foreach ($inventory['containers'] as &$container) {
                foreach ($container['items'] as &$item) {
                    if (!array_key_exists('uuid', $item)) {
                        $item['uuid'] = Uuid::uuid6()->toString();
                    }
                }
            }

            if (!array_key_exists('equipped', $inventory)) {
                $inventory['equipped'] = [
                    'armor' => [],
                    'weapon' => [],
                ];
            }

            $character->inventory = $inventory;
            $character->save();
        }

        return 0;
    }
}
