<?php

namespace Database\Seeders\Character;

use App\Models\Character\School;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Character\SchoolRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SchoolTypeRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use Database\Seeders\Seeder;
use Illuminate\Support\Arr;

final class SchoolSeeder extends Seeder
{


    public function run(
        SchoolRepositoryInterface $repository,
        SourceBookRepositoryInterface $sourceBooks,
        RingRepositoryInterface $rings,
        FamilyRepositoryInterface $families,
        TechniqueTypeRepositoryInterface $techniqueTypes,
        TechniqueSubtypeRepositoryInterface $techniqueSubtypes,
        SchoolTypeRepositoryInterface $schoolTypes,
    ): void {
        $data = $this->getData(School::class);

        foreach ($data as $datum) {
            $sourceBook = $sourceBooks->getByKey($datum['source_book']['key']);

            $create = Arr::only($datum, ['name', 'key', 'honor', 'ring_mode', 'starting_skill_amount', 'starting_skills', 'starting_techniques', 'starting_outfit', 'curriculum', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();

            if ($datum['family'] && $datum['family']['key'] != null) {
                $family = $families->getByKey($datum['family']['key']);
                $create['family_id'] = $family->getKey();
            }

            if ($datum['ring_one'] && $datum['ring_one']['key'] != null) {
                $ring = $rings->getByKey($datum['ring_one']['key']);
                $create['ring_one_id'] = $ring->getKey();
            }

            if ($datum['ring_two'] && $datum['ring_two']['key'] != null) {
                $ring = $rings->getByKey($datum['ring_two']['key']);
                $create['ring_two_id'] = $ring->getKey();
            }

            $school = $repository->create($create);
            assert($school instanceof School);

            foreach ($datum['available_technique_types'] as $techniqueType) {
                $type = $techniqueTypes->getByKey($techniqueType['key']);
                $school->availableTechniqueTypes()->attach($type);
            }

            foreach ($datum['available_technique_subtypes'] as $techniqueSubtype) {
                $subtype = $techniqueSubtypes->getByKey($techniqueSubtype['key']);
                $school->availableTechniqueSubtypes()->attach($subtype);
            }

            foreach ($datum['school_types'] as $schoolType) {
                $type = $schoolTypes->getByKey($schoolType['key']);
                $school->schoolTypes()->attach($type);
            }

            $school->mastery_ability_id = $datum['mastery_ability_id'];
            $school->school_ability_id = $datum['school_ability_id'];
        }
    }
}
