<?php

namespace Database\Migrations;

use App\Models\Character\Family;
use App\Models\Character\School;
use App\Models\Core\Ring;
use App\Models\Core\SchoolType;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueType;
use App\Repositories\Character\FamilyRepositoryInterface;
use App\Repositories\Character\SchoolRepositoryInterface;
use App\Repositories\Core\RingRepositoryInterface;
use App\Repositories\Core\SchoolTypeRepositoryInterface;
use App\Repositories\Core\SourceBookRepositoryInterface;
use App\Repositories\Core\TechniqueSubtypeRepositoryInterface;
use App\Repositories\Core\TechniqueTypeRepositoryInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\App;

abstract class InsertSchoolDataMigration extends Migration
{
    protected RingRepositoryInterface $rings;

    protected SchoolRepositoryInterface $repository;

    protected SchoolTypeRepositoryInterface $schoolTypes;

    protected SourceBookRepositoryInterface $books;

    protected TechniqueSubtypeRepositoryInterface $techniqueSubtypes;

    protected TechniqueTypeRepositoryInterface $techniqueTypes;

    protected FamilyRepositoryInterface $families;


    public function __construct()
    {
        $this->books = App::make(SourceBookRepositoryInterface::class);
        $this->repository = App::make(SchoolRepositoryInterface::class);
        $this->rings = App::make(RingRepositoryInterface::class);
        $this->schoolTypes = App::make(SchoolTypeRepositoryInterface::class);
        $this->techniqueSubtypes = App::make(TechniqueSubtypeRepositoryInterface::class);
        $this->techniqueTypes = App::make(TechniqueTypeRepositoryInterface::class);
        $this->families = App::make(FamilyRepositoryInterface::class);
    }


    protected function getSchool(string $key): School
    {
        $school = $this->repository->getByKey($key);
        assert($school instanceof School);

        return $school;
    }


    protected function getRing(string $key): Ring
    {
        $ring = $this->rings->getByKey($key);
        assert($ring instanceof Ring);

        return $ring;
    }


    protected function getTechniqueType(string $key): TechniqueType
    {
        $technique = $this->techniqueTypes->getByKey($key);
        assert($technique instanceof TechniqueType);

        return $technique;
    }


    protected function getSchoolType(string $key): SchoolType
    {
        $type = $this->schoolTypes->getByKey($key);
        assert($type instanceof SchoolType);

        return $type;
    }


    protected function getBook(string $key): SourceBook
    {
        $book = $this->books->getByKey($key);
        assert($book instanceof SourceBook);

        return $book;
    }


    protected function getFamily(string $key): Family
    {
        $family = $this->families->getByKey($key);
        assert($family instanceof Family);

        return $family;
    }
}
