<?php

namespace App\Console\Commands;

use App\StringHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Regex\Regex;

class ParseDisadvantagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:disadvantages {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse disadvantages';

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
    public function handle()
    {
        $type = $this->argument('type');
        assert(in_array($type, self::VALID_TYPES));

        $input = file_get_contents(base_path($type . '.txt'));
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
                $datum['disadvantage_key'] = StringHelper::key($result->group(1));
                if ($datum['disadvantage_key'] === 'shadowlands_taint') {
                    $datum['disadvantage_key'] .= '_' . $ring;
                }

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

        file_put_contents(base_path($this->argument('type') . '.json'), json_encode($data, JSON_PRETTY_PRINT));

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
        $line = Str::replace('', '\ns', $line);
        $line = Str::replace('', '\es', $line);

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
