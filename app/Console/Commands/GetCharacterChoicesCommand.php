<?php

namespace App\Console\Commands;

use App\Models\Character\Character;
use App\Repositories\Character\CharacterRepositoryInterface;
use Illuminate\Console\Command;

final class GetCharacterChoicesCommand extends Command
{
    /** @inheritDoc */
    protected $name = 'character:choices';

    /** @inheritDoc */
    protected $description = 'Export user choices to a json file.';


    /**
     * @return bool
     */
    public function handle(CharacterRepositoryInterface $repository): bool
    {
        $data = [
            'advantages' => [],
            'disadvantages' => [],
            'techniques' => [],
        ];

        $characters = $repository->all()->load(['advantages', 'disadvantages', 'techniques']);
        foreach ($characters as $character) {
            if (!$character instanceof Character) {
                continue;
            }

            foreach ($character->advantages as $advantage) {
                $sourceBook = $advantage->sourceBook->key;
                if (!array_key_exists($sourceBook, $data['advantages'])) {
                    $data['advantages'][$sourceBook] = [];
                }

                $data['advantages'][$sourceBook][] = $advantage->name;
            }

            foreach ($character->disadvantages as $disadvantage) {
                $sourceBook = $disadvantage->sourceBook->key;
                if (!array_key_exists($sourceBook, $data['disadvantages'])) {
                    $data['disadvantages'][$sourceBook] = [];
                }

                $data['disadvantages'][$sourceBook][] = $disadvantage->name;
            }

            foreach ($character->techniques as $technique) {
                $sourceBook = $technique->sourceBook->key;
                if (!array_key_exists($sourceBook, $data['techniques'])) {
                    $data['techniques'][$sourceBook] = [];
                }

                $data['techniques'][$sourceBook][] = $technique->name;
            }
        }

        foreach ($data as $type => $set) {
            foreach ($set as $book => $subset) {
                $data[$type][$book] = array_unique($data[$type][$book]);
            }
        }

        file_put_contents(base_path('data/exports/character-choices.json'), json_encode($data, JSON_PRETTY_PRINT));

        return true;
    }
}
