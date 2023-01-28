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
            $sourceBook = $sourceBooks->getByKey($datum['source_book_key']);

            $create = Arr::only($datum, ['name', 'key', 'honor', 'starting_skill_amount', 'starting_skills', 'starting_techniques', 'starting_outfit', 'curriculum', 'page_number']);
            $create['source_book_id'] = $sourceBook->getKey();

            if ($datum['family_key'] != null) {
                $family = $families->getByKey($datum['family_key']);
                $create['family_id'] = $family->getKey();
            }

            if ($datum['ring_one_key'] != null) {
                $ring = $rings->getByKey($datum['ring_one_key']);
                $create['ring_one_id'] = $ring->getKey();
            }

            if ($datum['ring_two_key'] != null) {
                $ring = $rings->getByKey($datum['ring_two_key']);
                $create['ring_two_id'] = $ring->getKey();
            }

            $school = $repository->create($create);
            assert($school instanceof School);

            foreach ($datum['available_technique_type_keys'] as $key) {
                $type = $techniqueTypes->getByKey($key);
                $school->availableTechniqueTypes()->attach($type);
            }

            foreach ($datum['available_technique_subtype_keys'] as $key) {
                $subtype = $techniqueSubtypes->getByKey($key);
                $school->availableTechniqueSubtypes()->attach($subtype);
            }

            foreach ($datum['school_type_keys'] as $key) {
                $type = $schoolTypes->getByKey($key);
                $school->schoolTypes()->attach($type);
            }
        }
    }
}
