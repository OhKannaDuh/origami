<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

abstract class SourceBookSeeder extends Seeder
{
    protected SourceBook $sourceBook;


    abstract protected function getSourceBookParameters(): array;


    public function getPhaseOneSeeders(): array
    {
        return [];
    }


    public function getPhaseTwoSeeders(): array
    {
        return [];
    }


    public function run(): void
    {
        $parameters = $this->getSourceBookParameters();
        $this->sourceBook = SourceBook::query()->create($parameters);
    }


    public function getSourceBook(): SourceBook
    {
        return $this->sourceBook;
    }
}
