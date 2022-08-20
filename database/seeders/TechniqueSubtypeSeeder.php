<?php

namespace Database\Seeders;

use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use App\StringHelper;
use Illuminate\Database\Seeder;

final class TechniqueSubtypeSeeder extends Seeder
{


    public function run(
        TechniqueSubtypeRepositoryInterface $techniqueSubtypes,
        TechniqueTypeRepositoryInterface $techniqueTypes,
    ): void {
        $techniqueSubtypes->createMany([
            $this->getData('General Kata', 'kata', $techniqueTypes),
            $this->getData('Close Combat Kata', 'kata', $techniqueTypes),
            $this->getData('Ranged Combat Kata', 'kata', $techniqueTypes),

            $this->getData('Earth Kiho', 'kiho', $techniqueTypes),
            $this->getData('Air Kiho', 'kiho', $techniqueTypes),
            $this->getData('Fire Kiho', 'kiho', $techniqueTypes),
            $this->getData('Water Kiho', 'kiho', $techniqueTypes),
            $this->getData('Void Kiho', 'kiho', $techniqueTypes),

            $this->getData('Air Invocations', 'invocations', $techniqueTypes),
            $this->getData('Earth Invocations', 'invocations', $techniqueTypes),
            $this->getData('Fire Invocations', 'invocations', $techniqueTypes),
            $this->getData('Water Invocations', 'invocations', $techniqueTypes),

            $this->getData('Rituals', 'rituals', $techniqueTypes),

            $this->getData('Air Shuji', 'shuji', $techniqueTypes),
            $this->getData('Earth Shuji', 'shuji', $techniqueTypes),
            $this->getData('Fire Shuji', 'shuji', $techniqueTypes),
            $this->getData('Water Shuji', 'shuji', $techniqueTypes),
            $this->getData('Void Shuji', 'shuji', $techniqueTypes),

            $this->getData('Maho', 'maho', $techniqueTypes),

            $this->getData('Ninjutsu', 'ninjutsu', $techniqueTypes),

            $this->getData('School Ability', 'ability', $techniqueTypes),
            $this->getData('Mastery Ability', 'ability', $techniqueTypes),
        ]);
    }


    private function getData(string $name, string $typeKey, TechniqueTypeRepositoryInterface $techniqueTypes): array
    {
        return [
            'technique_type_id' => $techniqueTypes->getByKey($typeKey)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
