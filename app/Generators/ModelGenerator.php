<?php

namespace App\Generators;

use App\Models\Character\Character;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use Based\TypeScript\Definitions\TypeScriptProperty;
use Doctrine\DBAL\Schema\Column;

final class ModelGenerator extends \Based\TypeScript\Generators\ModelGenerator
{

    protected const OVERRIDES = [
        School::class => [
            'starting_techniques' => '{[key: string]: StartingTechniqueData}',
            'starting_outfit' => 'StartingOutfitData[]',
            'curriculum' => 'SchoolCurriculum',
        ],
        Character::class => [
            'advancements' => 'Advancements',
            'inventory' => 'IInventory',
            'stats' => 'CharacterStats',
        ],
        Item::class => [
            'data' => 'WeaponData | ArmorData',
        ],
        Technique::class => [
            'description' => 'TechniqueDescription',
        ],
    ];


    protected function getProperties(): string
    {
        return $this->columns->map(function (Column $column) {
            $types = $this->getPropertyType($column->getType()->getName());

            if ($this->shouldOverride($column->getName())) {
                $types = $this->getOverride($column->getName());
            }

            return (string) new TypeScriptProperty(
                name: $column->getName(),
                types: $types,
                nullable: !$column->getNotnull()
            );
        })->join(PHP_EOL . '        ');
    }


    protected function shouldOverride(string $column): bool
    {
        $class = get_class($this->model);
        if (!array_key_exists($class, self::OVERRIDES)) {
            return false;
        }

        return array_key_exists($column, self::OVERRIDES[$class]);
    }


    protected function getOverride(string $column): string
    {
        return self::OVERRIDES[get_class($this->model)][$column];
    }
}
