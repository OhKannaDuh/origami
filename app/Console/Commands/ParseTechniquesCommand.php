<?php

namespace App\Console\Commands;

use App\Models\Character\Technique;
use App\StringHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Stringable;
use Spatie\Regex\Regex;

class ParseTechniquesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'techniques:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = base_path('data/imports/techniques.json');
        $contents = file_get_contents($path);
        $techniques = json_decode($contents, true);
        $output = [];

        foreach ($techniques as $data) {
            $line = implode(' ', $data['lines']);
            $line = StringHelper::of($line)->ascii();
            $line = $line->replace('- ', '');

            $activation = $this->getActivation($line);
            $effect = $this->getEffects($line);
            $opportunities = $this->getOpportunities($data['lines']);

            $technique = Technique::repository()->getByKey($data['key']);
            assert($technique instanceof Technique);
            $description = $technique->description;
            $description['activation'] = $activation;
            $description['effect'] = $effect;
            $description['opportunities'] = $opportunities;
            $technique->description = $description;
            $technique->save();

            $output[] = [
                'key' => $data['key'],
                'activation' => $activation,
                'effect' => $effect,
                'opportunities' => $opportunities
            ];
        }

        $path = base_path('data/exports/parsed-techniques.json');
        file_put_contents($path, json_encode($output, JSON_PRETTY_PRINT));

        return 0;
    }


    private function getActivation(Stringable $line): string
    {
        $activation = $line->after('Activation:')->before('Effects:')->trim();
        if ($activation->contains('{{opportunity}} in the following way:')) {
            $start = $activation->before('{{opportunity}} in the following way:')->append('{{opportunity}} in the following way:');

            $items = [];
            $after = $activation->after('{{opportunity}} in the following way:');
            $items[] = [
                'cost' => $after->before(':')->toString(),
                'effect' => $after->after(':')->trim()->toString(),
            ];

            return view('activation.following-way', [
                'start' => $start,
                'items' => $items,
            ])->render();
        }

        return view('activation.default', [
            'activation' => $activation,
        ])->render();
    }


    private function getEffects(Stringable $line): ?string
    {
        if (!$line->contains('Effects:')) {
            return null;
        }

        $effect = $line->after('Effects:')->before('New Opportunities')->trim();

        if ($effect->contains('$')) {
            $items = [];
            $result = Regex::matchAll('/\$(.*?)\./i', $line);
            foreach ($result->results() as $result) {
                $item = StringHelper::of($result->group(0))->replace('$ ', '');
                $items[] = [
                    'string' => $result->group(0),
                    'title' => $item->before(':'),
                    'description' => $item->after(':')->trim(),
                ];
            }

            $start = $effect->before(Arr::first($items)['string'])->trim();
            $end = $effect->afterLast(Arr::last($items)['string'])->trim();

            return view('effects.with-list', [
                'start' => $start,
                'items' => $items,
                'end' => $end,
            ])->render();
        }

        return view('effects.default', [
            'effects' => $effect->toString(),
        ])->render();
    }


    private function getOpportunities(array $lines): array
    {
        $opportunities = [];
        $opportunityLines = [];

        $found = false;
        foreach ($lines as $line) {
            if (Regex::match('/New Opportunities/i', $line)->hasMatch()) {
                $found = true;
                continue;
            }

            if (!$found) {
                continue;
            }

            $result = Regex::match('/\{\{opportunity\}\}\+?: /i', $line);
            if ($result->hasMatch()) {
                if (!empty($opportunityLines)) {
                    $opportunities[] = implode(' ', $opportunityLines);
                    $opportunityLines = [];
                }
            }

            $opportunityLines[] = $line;
        }

        if (!empty($opportunityLines)) {
            $opportunities[] = implode(' ', $opportunityLines);
        }

        $output = [];
        foreach ($opportunities as $opportunity) {
            $output[] = [
                'cost' => StringHelper::of($opportunity)->before(':')->replace('}} {{', '}}{{')->toString(),
                'effect' => StringHelper::of($opportunity)->after(':')->replace('- ', '')->replace('}} {{', '}}{{')->toString(),
            ];
        }

        return $output;
    }
}
