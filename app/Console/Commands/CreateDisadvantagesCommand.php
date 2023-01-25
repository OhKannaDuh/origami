<?php

namespace App\Console\Commands;

use App\Models\Character\Disadvantage;
use App\Models\Core\DisadvantageCategory;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Core\DisadvantageCategoryRepositoryInterface;
use App\StringHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Regex\Regex;

class CreateDisadvantagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:disadvantages {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make disadvantages';

    private const VALID_TYPES = [
        'adversities',
        'anxieties',
    ];

    private const RING_KEYS = [
        'air',
        'earth',
        'fire',
        'water',
        'void',
    ];

    private const STATE_LOOKING_FOR_NAME = 0;

    private const PATTERN_NAME = '/(.*?) \((.*?)\)$/';

    private const STATE_LOOKING_FOR_TYPES = 1;

    private const PATTERN_TYPES = '/^Types: (.*?)$/';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        DisadvantageRepositoryInterface $disadvantages,
        DisadvantageCategoryRepositoryInterface $categories,
    ) {
        $type = $this->argument('type');
        assert(in_array($type, self::VALID_TYPES));

        $contents = file_get_contents(base_path($type . '.json'));
        $data = json_decode($contents, true);

        foreach ($data as $datum) {
            $disadvantage = $disadvantages->getByKey($datum['disadvantage_key']);
            assert($disadvantage instanceof Disadvantage);

            $disadvantage->update([
                'effects' => $datum['effects'],
            ]);

            foreach ($datum['type_keys'] as $key) {
                if (in_array($key, ['interpersonal_name', 'mental_and_interpersonal', 'physical_or_mental'])) {
                    continue;
                }

                $category = $categories->getByKey($key);
                assert($category instanceof DisadvantageCategory);

                if ($disadvantage->disadvantageCategories->contains($category)) {
                    continue;
                }

                $disadvantage->disadvantageCategories()->attach($category);
            }
        }

        return 0;
    }


    private function isRingKey(string $key): bool
    {
        return in_array($key, self::RING_KEYS);
    }


    private function formatEffects(array $lines): string
    {
        $indexes = [];
        foreach ($lines as $index => $line) {
            $line = Str::replace(' ', '', $line);
            $line = Str::lower($line);
            if (str_contains($line, 'chapter')) {
                $indexes[] = $index;
            }
        }

        Arr::forget($lines, $indexes);

        $line = implode(' ', $lines);
        $line = Str::replace('- ', '', $line);
        $effects = explode(' $ ', $line);

        $intro = Arr::first($effects);
        $intro = Str::replace('Effects: ', '', $intro);

        $output = '<p>' . $intro . '</p><ul>';

        Arr::forget($effects, 0);
        foreach ($effects as $effect) {
            $output .= '<li>' . $effect . '</li>';
        }

        $output .= '</ul>';

        return $output;
    }
}
