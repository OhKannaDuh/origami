<?php

namespace App\Console\Commands;

use App\Models\Character\Technique;
use App\Repositories\Character\TechniqueRepositoryInterface;
use App\StringHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class GetInvalidTechniquesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'techniques:invalid';

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
        $descriptions = [];
        $techniques = Technique::all();
        foreach ($techniques as $technique) {
            assert($technique instanceof Technique);
            $technique->load('sourceBook');
            $description = $technique->description;

            $full = $description['activation'] ?? '' . $description['effect'] ?? ''  . $description['enhancement'] ?? ''  . $description['burst'] ?? '';
            if ($full !== '' || !empty($description['opportunities'])) {
                continue;
            }

            $book = $technique->sourceBook->key;
            if (!array_key_exists($book, $descriptions)) {
                $description[$book] = [];
            }

            $descriptions[$book][] = [
                'key' => $technique->key,
                'page_number' => $technique->page_number,
            ];
        }

        $output = collect($descriptions);
        $output = $output->map(fn(array $item): Collection => collect($item)->sortBy('page_number'));

        $output = $output->map(function (Collection $items): array {
            $items = $items->map(fn(array $keys): string => $keys['key']);

            return $items->values()->toArray();
        });


        file_put_contents(base_path('data/exports/techniques-without-descriptions.json'), json_encode($output, JSON_PRETTY_PRINT));

        return 0;
    }
}
