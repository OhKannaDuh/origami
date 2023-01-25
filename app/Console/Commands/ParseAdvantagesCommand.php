<?php

namespace App\Console\Commands;

use App\Models\Character\Advantage;
use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Core\AdvantageCategoryRepositoryInterface;
use App\StringHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Regex\Regex;

class ParseAdvantagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distinctions:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse distinctions from a source book as plain text.';

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

    private const STATE_LOOKING_FOR_EFFECTS = 2;


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(AdvantageRepositoryInterface $advantages, AdvantageCategoryRepositoryInterface $categories): int
    {
        $input = file_get_contents(base_path('passions.txt'));
        $lines = explode(PHP_EOL, $input);

        $state = self::STATE_LOOKING_FOR_NAME;

        $data = [];
        $datum = ['lines' => []];

        foreach ($lines as $line) {
            if ($state === self::STATE_LOOKING_FOR_NAME) {
                $result = Regex::match(self::PATTERN_NAME, $line);
                if (!$result->hasMatch()) {
                    $datum['lines'][] = $line;
                    continue;
                }

                $ring = StringHelper::key($result->group(2));
                if (!$this->isRingKey($ring)) {
                    continue;
                }

                if ($datum['lines']) {
                    $datum['effects'] = $this->formatEffects($datum['lines']);
                    Arr::forget($datum, 'lines');
                    $data[] = $datum;
                    $datum = ['lines' => []];
                }

                $datum['ring_key'] = $ring;
                $datum['advantage_key'] = StringHelper::key($result->group(1));

                $state = self::STATE_LOOKING_FOR_TYPES;
                continue;
            }

            if ($state === self::STATE_LOOKING_FOR_TYPES) {
                $result = Regex::match(self::PATTERN_TYPES, $line);
                if (!$result->hasMatch()) {
                    continue;
                }

                $types = $result->group(1);
                $types = explode(', ', $types);
                $types = array_map(fn (string $type): string => StringHelper::key($type), $types);
                $datum['type_keys'] = $types;

                $state = self::STATE_LOOKING_FOR_NAME;
            }
        }

        // foreach ($data as $datum) {
        //     $advantage = $advantages->getByKey($datum['advantage_key']);
        //     assert($advantage instanceof Advantage);

        //     $advantage->update([
        //         'effects' => $datum['effects'],
        //     ]);

        //     // foreach ($datum['type_keys'] as $key) {
        //     //     $advantage->advantageCategories()->attach($categories->getByKey($key));
        //     // }
        // }

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
