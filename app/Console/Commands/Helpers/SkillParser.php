<?php

namespace App\Console\Commands\Helpers;

use App\Models\Core\Skill;
use App\StringHelper;

final class SkillParser
{


    public function parse(array $lines): array
    {
        $data = [];
        $skillLines = [];
        $start = false;

        foreach ($lines as $line) {
            $line = StringHelper::transliterate($line);
            if (preg_match('/Starting Skills \(choose(.*)/', $line) === 1) {
                $start = true;
            }

            if (preg_match('/Honor: [0-9]*/', $line) === 1) {
                $skills = implode(' ', $skillLines);

                $matches = [];
                preg_match('/Starting Skills \(choose (.*)\):/', $skills, $matches);
                $data['skill_amount'] = StringHelper::wordToNumber($matches[1]);

                $matches = [];
                preg_match_all('/\+1 (.*?)(,|$)/', $skills, $matches);
                $data['skills'] = [];
                foreach ($matches[1] as $skillName) {
                    $skillName = StringHelper::replace(['[', ']', '- '], ['(', ')', ''], $skillName);
                    $data['skills'][] = Skill::query()->where('name', $skillName)->first(['key'])->key;
                }

                return $data;
            }

            if ($start) {
                $skillLines[] = $line;
            }
        }

        return [];
    }
}
