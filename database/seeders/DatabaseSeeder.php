<?php

namespace Database\Seeders;

use Database\Seeders\SourceBooks\SourceBookSeeder;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $this->call([
            RingSeeder::class,
            SkillGroupSeeder::class,
            SkillSeeder::class,
            TechniqueTypeSeeder::class,
            TechniqueSubtypeSeeder::class,
            SchoolTypeSeeder::class,
            ItemTypeSeeder::class,
            ItemSubtypeSeeder::class,
            AdvantageTypeSeeder::class,
            DisadvantageTypeSeeder::class,
        ]);



        $books = [
            SourceBooks\Core\Seeder::class,
            SourceBooks\EmeraldEmpire\Seeder::class,
            SourceBooks\Shadowlands\Seeder::class,
            SourceBooks\CourtsOfStone\Seeder::class,
            SourceBooks\PathOfWaves\Seeder::class,
            SourceBooks\CelestialRealms\Seeder::class,
            SourceBooks\FieldsOfVictory\Seeder::class,
        ];

        /** @var SourceBookSeeder[] $seeders */
        $seeders = [];
        foreach ($books as $class) {
            $seeders[] = $this->resolve($class);
        }
        foreach ($seeders as $seeder) {
            with(new Task($this->command->getOutput()))->render(
                get_class($seeder),
                fn () => $seeder->__invoke(),
            );

            $this->callWith($seeder->getPhaseOneSeeders(), [
                'sourceBook' => $seeder->getSourceBook(),
            ]);
        }

        foreach ($seeders as $seeder) {
            $this->callWith($seeder->getPhaseTwoSeeders(), [
                'sourceBook' => $seeder->getSourceBook(),
            ]);
        }
    }
}
