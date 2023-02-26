<?php

use Database\Migrations\InsertSchoolDataMigration;
use Database\Seeders\Helpers\StartingOutfit;

return new class extends InsertSchoolDataMigration
{


    public function up(): void
    {
        $school = $this->getSchool('daidoji_spymaster_school');

        $school->starting_outfit = $this->getStartingOutfit()->toArray();

        $school->save();
    }


    private function getStartingOutfit(): StartingOutfit
    {
        return (new StartingOutfit())
            ->withItem('traveling_clothes')
            ->withItem('ceremonial_clothes')
            ->withItem('wakizashi')
            ->withItem('sokutoki')
            ->withItem('disguise_kit')
            ->withItem('opening_and_closing_tools');
    }
};
