<?php

namespace Database\Seeders;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

final class DatabaseSeeder extends Seeder
{


    public function run(UserRepositoryInterface $users): void
    {
        $this->call([
            Core\SourceBookSeeder::class,
            Core\RingSeeder::class,
            Character\ItemTypeSeeder::class,
            Character\ItemSubtypeSeeder::class,
            Character\ItemSeeder::class,
            Core\SkillGroupSeeder::class,
            Core\SkillSeeder::class,
            Core\TechniqueTypeSeeder::class,
            Core\TechniqueSubtypeSeeder::class,
            Character\TechniqueSeeder::class,
            Core\AdvantageTypeSeeder::class,
            Core\DisadvantageTypeSeeder::class,
            Core\AdvantageCategorySeeder::class,
            Core\DisadvantageCategorySeeder::class,
            Character\AdvantageSeeder::class,
            Character\DisadvantageSeeder::class,
            Character\ClanSeeder::class,
            Character\FamilySeeder::class,
            Core\SchoolTypeSeeder::class,
            Character\SchoolSeeder::class,
        ]);

        Artisan::call('user:import');

        $user = $users->getById(1);
        assert($user instanceof User);

        $user->admin = 1;
        $user->save();
    }
}
