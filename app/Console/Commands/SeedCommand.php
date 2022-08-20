<?php

namespace App\Console\Commands;

use App\StringHelper;
use Illuminate\Database\Eloquent\Model;

final class SeedCommand extends \Illuminate\Database\Console\Seeds\SeedCommand
{
    /** @var class-string<Model>[] */
    private const MODELS = [
        \App\Models\Character\Advantage::class,
        \App\Models\Character\Clan::class,
        \App\Models\Character\Disadvantage::class,
        \App\Models\Character\Family::class,
        \App\Models\Character\Item::class,
        \App\Models\Character\School::class,
        \App\Models\Character\Technique::class,
        \App\Models\Core\AdvantageType::class,
        \App\Models\Core\DisadvantageType::class,
        \App\Models\Core\ItemSubtype::class,
        \App\Models\Core\ItemType::class,
        \App\Models\Core\Ring::class,
        \App\Models\Core\SchoolType::class,
        \App\Models\Core\Skill::class,
        \App\Models\Core\SkillGroup::class,
        \App\Models\Core\SourceBook::class,
        \App\Models\Core\TechniqueSubtype::class,
        \App\Models\Core\TechniqueType::class,
    ];


    public function handle(): int
    {
        $result = parent::handle();
        if ($result === 0) {
            $this->generateSnippets();
        }

        return $result;
    }


    private function generateSnippets(): void
    {
        $output = [];


        $template = "\t\"[name]\": {\n\t\t\"prefix\": \"[key]\",\n\t\t\"body\": \"[key]\",\n\t}";

        foreach (self::MODELS as $class) {
            foreach ($class::all(['key', 'name']) as $model) {
                if (!property_exists($model, 'key') || !property_exists($model, 'name')) {
                    continue;
                }

                $className = StringHelper::of($class)->afterLast('\\')->toString();
                $name = "{$className}:{$model->name}";
                $output[$name] = StringHelper::of($template)
                ->replace(['[name]', '[key]'], [$name, $model->key])
                ->toString();
            }
        }

        $output = implode(',' . PHP_EOL, $output);
        $output = '{' . PHP_EOL . $output . PHP_EOL . '}';
        if (file_exists(base_path('.vscode'))) {
            file_put_contents(base_path('.vscode/keys.code-snippets'), $output);
        }
    }
}
