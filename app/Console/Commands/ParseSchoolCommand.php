<?php

namespace App\Console\Commands;

use App\Console\Commands\Helpers\CurriculumParser;
use App\Console\Commands\Helpers\HonorParser;
use App\Console\Commands\Helpers\MasteryAbilityParser;
use App\Console\Commands\Helpers\NameParser;
use App\Console\Commands\Helpers\RingParser;
use App\Console\Commands\Helpers\SchoolAbilityParser;
use App\Console\Commands\Helpers\SkillParser;
use App\Console\Commands\Helpers\StartingOutfitParser;
use App\Console\Commands\Helpers\StartingTechniquesParser;
use App\Console\Commands\Helpers\TechniquesAvailableParser;
use App\StringHelper;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

final class ParseSchoolCommand extends GeneratorCommand
{
    protected $signature = 'school:parse';

    protected $description = 'Parse a school from a source book as plain text to creation notaion for a school';


    /** @inheritDoc */
    protected function getStub(): string
    {
        return $this->files->get(base_path('stubs/school.stub'));
    }


    public function handle(): bool
    {
        $files = [];
        $paths = scandir(base_path('schools/plain'));
        foreach ($paths as $path) {
            $fullPath = base_path('schools/plain/' . $path);
            if (is_dir($fullPath)) {
                continue;
            }

            $files[] = $fullPath;
        }

        foreach ($files as $path) {
            $input = file_get_contents($path);
            $lines = explode(PHP_EOL, $input);

            $data = [];
            $data += (new NameParser())->parse($lines);
            $this->output->writeln('<info>' . $data['name'] . '</>');

            $data += (new RingParser())->parse($lines);
            $data += (new SkillParser())->parse($lines);
            $data += (new HonorParser())->parse($lines);
            $data += (new TechniquesAvailableParser())->parse($lines);
            $data += (new StartingTechniquesParser())->parse($lines);
            $data += (new SchoolAbilityParser())->parse($lines);
            $data += (new StartingOutfitParser())->parse($lines);
            $data += (new CurriculumParser())->parse($lines);
            $data += (new MasteryAbilityParser())->parse($lines);

            $className = StringHelper::replace(' ', '', $data['name']) . 'Seeder';

            $types = implode('\', \'', $data['types']);

            $skills = Arr::map($data['skills'], fn (string $skill): string => "->withKey('{$skill}')");
            $skills = implode("\n                ", $skills);

            $techniquesAvailable = implode('\', \'', $data['techniques_available']);

            $stub = StringHelper::of($this->getStub())
                ->replace('{{ className }}', $className)
                ->replace('{{ schoolName }}', $data['name'])
                ->replace('{{ schoolTypes }}', $types)
                ->replace('{{ ringOne }}', $data['ring_one'])
                ->replace('{{ ringTwo }}', $data['ring_two'])
                ->replace('{{ skillAmount }}', $data['skill_amount'])
                ->replace('{{ skills }}', $skills)
                ->replace('{{ honor }}', $data['honor'])
                ->replace('{{ techniquesAvailable }}', $techniquesAvailable)
                ->replace('{{ startingTechniques }}', view('schools.starting-techniques', $data))
                ->replace('{{ schoolAbility }}', $data['school_ability'])
                ->replace('{{ startingOutfit }}', implode(', ', $data['starting_outfit']))
                ->replace('{{ curriculum }}', view('schools.curriculum', $data))
                ->replace('{{ masteryAbility }}', $data['mastery_ability']);

            $this->output->writeln("\tDone");
            $this->files->put(base_path('schools/' . $className . '.php'), $stub);
        }

        return true;
    }
}
