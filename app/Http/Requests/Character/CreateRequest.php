<?php

namespace App\Http\Requests\Character;

use App\Http\Requests\AuthRequest;
use App\Models\Character\Advantage;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Repositories\Character\TechniqueRepositoryInterface;
use App\Validation\Rules;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

final class CreateRequest extends AuthRequest
{


    private function getTechniqueRepository(): TechniqueRepositoryInterface
    {
        $repository = App::make(TechniqueRepositoryInterface::class);
        assert($repository instanceof TechniqueRepositoryInterface);
        return $repository;
    }


    public function getAttributes(): array
    {
        $data = $this->all();

        $attributes =  [
            'name' => Arr::get($data, 'character.name'),
            'clan_id' => Arr::get($data, 'character.clan.id'),
            'family_id' => Arr::get($data, 'character.family.id'),
            'school_id' => Arr::get($data, 'character.school.id'),
            'personality' => [
                'lord' => Arr::get($data, 'character.lord', ''),
                'giri' => Arr::get($data, 'character.giri', ''),
                'ninjo' => Arr::get($data, 'character.ninjo', ''),
                'first_notice' => Arr::get($data, 'character.firstNotice', ''),
                'stress' => Arr::get($data, 'character.stress', ''),
                'death' => Arr::get($data, 'character.death', ''),
                'relationships' => [],
            ],
            'heritage' => [],
            'stats' => [
                'rings' => [
                    'air' => Arr::get($data, 'character.rings.air.rank'),
                    'earth' => Arr::get($data, 'character.rings.earth.rank'),
                    'fire' => Arr::get($data, 'character.rings.fire.rank'),
                    'void' => Arr::get($data, 'character.rings.void.rank'),
                    'water' => Arr::get($data, 'character.rings.water.rank'),
                ],
                'social' => [
                    'honor' => Arr::get($data, 'character.honor'),
                    'glory' => Arr::get($data, 'character.glory'),
                    'status' => Arr::get($data, 'character.status'),
                ],
                'conflict' => [
                    'strife' => 0,
                    'fatigue' => 0,
                    'void_points' => (int) ceil(Arr::get($data, 'character.rings.air.rank', 0) / 2),
                ],
            ],
        ];

        Arr::set(
            $attributes,
            'personality.relationships.mentor',
            Arr::get($data, 'character.mentor.description', ''),
        );

        Arr::set(
            $attributes,
            'personality.relationships.otherRelationships',
            Arr::get($data, 'character.otherRelationships.description', ''),
        );

        Arr::set(
            $attributes,
            'personality.relationships.parentRelationship',
            Arr::get($data, 'character.parentRelationship.description', ''),
        );

        $attributes['heritage'] = Arr::get($data, 'character.heritage', []);

        return $attributes;
    }


    public function getSkills(): array
    {
        $skills = Arr::get($this->all(), 'character.skills', []);
        assert(is_array($skills));

        return Arr::map($skills, fn(array $data): int => $data['rank']);
    }


    public function getStartingItems(): array
    {
        $data = $this->all();

        $output = [];
        $choices = Arr::get($data, 'character.school.outfit', []);
        assert(is_array($choices));

        $startingOutfit = Arr::get($data, 'character.school.starting_outfit');
        assert(is_array($startingOutfit));

        foreach ($startingOutfit as $key => $outfit) {
            if ($outfit['type'] === 'item') {
                $output[] = [
                    'item_key' => $outfit['item_key'],
                    'quantity' => $outfit['quantity'] ?? 1,
                ];
            }

            if ($outfit['type'] === 'choice') {
                foreach ($choices[$key] as $choice) {
                    $output[] = [
                        'item_key' => $choice['key'],
                        'quantity' => 1,
                    ];
                }
            }

            if ($outfit['type'] === 'daisho') {
                $output[] = [
                    'item_key' => 'katana',
                    'quantity' => 1,
                ];

                $output[] = [
                    'item_key' => 'wakizashi',
                    'quantity' => 1,
                ];
            }
        }

        $heritages = Arr::get($data, 'character.heritage', []);
        assert(is_array($heritages));

        foreach ($heritages as $heritage) {
            if (Arr::has($heritage, 'item.key')) {
                $output[] = [
                    'item_key' => $heritage['item']['key'],
                    'quantity' => 1,
                ];
            }
        }

        $output[] = [
            'item_key' => Arr::get($data, 'character.otherRelationships.item.key'),
            'quantity' => 1,
        ];

        return $output;
    }


    public function getTravelingPackItems(): array
    {
        $data = $this->all();

        if (!Arr::has($data, 'character.school.outfit.traveling_pack')) {
            return [];
        }

        $output = [
            [
                'item_key' => 'blanket',
                'quantity' => 1,
            ],
            [
                'item_key' => 'bowl',
                'quantity' => 1,
            ],
            [
                'item_key' => 'chopsticks',
                'quantity' => 1,
            ],
            [
                'item_key' => 'traveling_rations',
                'quantity' => 4,
            ],
            [
                'item_key' => 'flint_and_tinder',
                'quantity' => 1,
            ],
        ];

        $items = Arr::get($data, 'character.school.outfit.traveling_pack', []);
        assert(is_array($items));

        foreach ($items as $item) {
            $output[] = [
                'item_key' => $item['key'],
                'quantity' => 1,
            ];
        }

        return $output;
    }


    public function getAdvantages(): array
    {
        $data = $this->all();

        $output = [
            Arr::get($data, 'character.distinction.id'),
            Arr::get($data, 'character.passion.id'),
        ];

        if (Arr::has($data, 'character.mentor.advantage.id')) {
            $output[] = Arr::get($data, 'character.mentor.advantage.id');
        }

        $heritages = Arr::get($data, 'character.heritage', []);
        assert(is_array($heritages));

        foreach ($heritages as $heritage) {
            if (Arr::has($heritage, 'effect.advantage.id')) {
                $output[] = Arr::get($heritage, 'effect.advantage.id');
            }
        }

        return $output;
    }


    public function getDisadvantages(): array
    {
        $data = $this->all();

        $output = [
            Arr::get($data, 'character.adversity.id'),
            Arr::get($data, 'character.anxiety.id'),
        ];

        if (Arr::has($data, 'character.mentor.disadvantage.id')) {
            $output[] = Arr::get($data, 'character.mentor.disadvantage.id');
        }

        return $output;
    }


    public function getTechniques(): array
    {
        $data = $this->all();
        $techniques = $this->getTechniqueRepository();

        $startingTechniques = Arr::get($data, 'character.school.starting_techniques', []);
        assert(is_array($startingTechniques));

        $output = [];
        foreach ($startingTechniques as $group) {
            if ($group['type'] !== 'group') {
                continue;
            }

            foreach ($group['techniques'] as $key) {
                $output[] = $techniques->getByKey($key)->getKey();
            }
        }

        $chosen = $this->getTechniqueChoices();
        foreach ($chosen as $chosenTechniques) {
            foreach ($chosenTechniques as $key) {
                $output[] = $techniques->getByKey($key)->getKey();
            }
        }

        return $output;
    }


    private function getKeysFromArray(array $array, string $key = 'key'): array
    {
        $keys = [];
        foreach ($array as $item) {
            if ($item[$key]) {
                $keys[] = $item[$key];
            }
        }


        return $keys;
    }


    private function getTechniqueChoices(): array
    {
        $techniques = Arr::get($this->all(), 'character.school.techniques', []);
        assert(is_array($techniques));

        $choices = [];
        foreach ($techniques as $key => $data) {
            $choices[$key] = $this->getKeysFromArray($data);
        }

        return $choices;
    }


    public function rules(): array
    {
        return [
            // Required
            'character.name' => (new Rules())
                ->required()
                ->string(),
            'character.clan.id' => (new Rules())
                ->required()
                ->exists(Clan::class),
            'character.family.id' => (new Rules())
                ->required()
                ->exists(Family::class),
            'character.school.id' => (new Rules())
                ->required()
                ->exists(School::class),
            'character.otherRelationships.item.key' => (new Rules())
                ->required()
                ->string()
                ->exists(Item::class, 'key'),
            'character.rings.*.rank' => (new Rules())
                ->required()
                ->integer(),
            'character.honor' => (new Rules())
                ->required()
                ->integer(),
            'character.glory' => (new Rules())
                ->required()
                ->integer(),
            'character.status' => (new Rules())
                ->required()
                ->integer(),
            'character.school.starting_outfit.*.type' => (new Rules())
                ->required()
                ->string()
                ->in(['item', 'choice', 'daisho', 'traveling_pack']),
            'character.distinction.id' => (new Rules())
                ->required()
                ->exists(Advantage::class),
            'character.passion.id' => (new Rules())
                ->required()
                ->exists(Advantage::class),
            'character.adversity.id' => (new Rules())
                ->required()
                ->exists(Disadvantage::class),
            'character.anxiety.id' => (new Rules())
                ->required()
                ->exists(Disadvantage::class),
            'character.school.starting_techniques' => (new Rules())
                ->required()
                ->array(),
            'character.school.starting_techniques.*.type' => (new Rules())
                ->required()
                ->string()
                ->in(['group', 'choice']),
            'character.school.starting_techniques.*.techniques.*' => (new Rules())
                ->present()
                ->required()
                ->string()
                ->exists(Technique::class, 'key'),
            'character.school.starting_outfit.*.item_key' => (new Rules())
                ->requiredIf('character.school.starting_outfit.*.type,item')
                ->string()
                ->exists(Item::class, 'key'),

            // Optional
            'character.lord' => (new Rules())
                ->string(),
            'character.giri' => (new Rules())
                ->string(),
            'character.ninjo' => (new Rules())
                ->string(),
            'character.firstNotice' => (new Rules())
                ->string(),
            'character.stress' => (new Rules())
                ->string(),
            'character.death' => (new Rules())
                ->string(),
            'character.mentor.description' => (new Rules())
                ->string(),
            'character.otherRelationships.description' => (new Rules())
                ->string(),
            'character.parentRelationship.description' => (new Rules())
                ->string(),
            'character.heritage' => (new Rules())
                ->array(),
            'character.skills' => (new Rules())
                ->array(),
            'character.school.outfit' => (new Rules())
                ->array(),
            'character.school.outfit.traveling_pack' => (new Rules())
                ->array(),
            'character.school.starting_outfit' => (new Rules())
                ->array(),
            'character.school.starting_outfit.*.quantity' => (new Rules())
                ->integer(),
            'character.school.techniques' => (new Rules())
                ->array(),
            'character.mentor.advantage.id' => (new Rules())
                ->exists(Advantage::class),
            'character.mentor.disadvantage.id' => (new Rules())
                ->exists(Disadvantage::class),
        ];
    }
}
