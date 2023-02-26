<?php

namespace App\Console\Commands;

use App\Console\Commands\Export\Export as BaseExport;
use App\StringHelper;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:data {version} {--force}';

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
        $version = 'v' . $this->argument('version');
        $force = $this->option('force');

        $path = '/home/liam/Code/origami-data/data/' . $version;
        if (File::isDirectory($path)) {
            if (!$force) {
                throw new Exception('Folder ' . $path . ' already exists. (--force to ignore).') ;
            }
        } else {
            File::makeDirectory($path);
        }


        $this->store(new Export\AdvantageCategoryExport(), $path);
        $this->store(new Export\AdvantageExport(), $path);
        $this->store(new Export\AdvantageTypeExport(), $path);
        $this->store(new Export\CampaignExport(), $path);
        $this->store(new Export\CharacterExport(), $path);
    }


    private function store(BaseExport $exporter, string $path): void
    {
        $class = $exporter->getClass();
        $class = StringHelper::of($class)->afterLast('\\')->toString();
        $fullPath = $path . '/' . StringHelper::snake($class) . '.json';
        $data = $exporter->getData();

        file_put_contents($fullPath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
