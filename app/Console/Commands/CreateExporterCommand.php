<?php

namespace App\Console\Commands;

use App\Exceptions\FileAlreadyExistsException;
use App\StringHelper;
use Exception;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\App;
use ReflectionClass;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use UnexpectedValueException;

class CreateExporterCommand extends GeneratorCommand
{
    /** @inheritDoc */
    protected $name = 'export:create';

    /** @inheritDoc */
    protected $type = 'Export';

    /** @inheritDoc */
    protected $description = 'Create a new Repository and Interface for the given model';


    /** @inheritDoc */
    protected function getStub(): string
    {
        throw new Exception();
    }


    /** @inheritDoc */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Repositories';
    }


    /**
     * @return array<mixed[]>
     */
    protected function getArguments(): array
    {
        return [
            ['model', InputArgument::REQUIRED, 'The model to create a repository for'],
        ];
    }


    /**
     * @return array<mixed[]>
     */
    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the repository already exists'],
        ];
    }


    /**
     * @return bool
     */
    public function handle(): bool
    {
        $force = (bool) $this->option('force');
        $modelArgument = $this->argument('model');
        if (!is_string($modelArgument)) {
            throw new UnexpectedValueException();
        }

        // Handle model
        $fullyQualifiedModel = $this->qualifyModel(trim($modelArgument));
        $modelName = StringHelper::afterLast($fullyQualifiedModel, '\\');

        $interface = StringHelper::replace('Models', 'Repositories', $fullyQualifiedModel) . 'RepositoryInterface';

        $path = __DIR__ . '/Export/' . $modelName . 'Export.php';
        $stub = $this->generateStub($fullyQualifiedModel, $interface);

        $this->output->info('Creating: ' . $path);
        $this->files->put($path, $stub);

        return true;
    }


    /**
     * @param string $fullyQualifiedModel
     * @param string $interface
     *
     * @return string
     */
    private function generateStub(string $fullyQualifiedModel, string $interface): string
    {
        $model = StringHelper::afterLast($fullyQualifiedModel, '\\');


        $stub = $this->files->get(base_path('stubs/export.stub'));
        $stub = $this->replaceClass($stub, $model . 'Export');
        $stub = StringHelper::replace('{{ repository }}', $interface, $stub);
        $stub = StringHelper::replace('{{ repositoryName }}', StringHelper::afterLast($interface, '\\'), $stub);
        $stub = StringHelper::replace('{{ relationships }}', $this->getRelationships($fullyQualifiedModel), $stub);

        return $this->sortImports($stub);
    }


    /**
     * @param string $path
     *
     * @return string
     */
    public function getStubsFile(string $path): string
    {
        if ($this->files->exists(base_path($path))) {
            return $this->files->get(base_path($path));
        }

        return $this->files->get(__DIR__ . '../../' . $path);
    }


    private function getRelationships(string $model)
    {
        $model = App::make($model);
        assert($model instanceof Model);
        $reflection = new ReflectionClass(get_class($model));

        $relationships = [];
        foreach ($reflection->getMethods() as $method) {
            $type = (string) $method->getReturnType();
            if (!$this->isRealtionshipType($type)) {
                continue;
            }

            $relationships[] = $method->getName();
        }

        if (empty($relationships)) {
            return '';
        }

        $padding = str_repeat(' ', 12);
        $output = PHP_EOL;
        foreach ($relationships as $relationship) {
            $output .= $padding . "'{$relationship}'," . PHP_EOL;
        }

        $output .= str_repeat(' ', 8);

        return $output;
    }


    private function isRealtionshipType(string $type): bool
    {
        return $this->isManyRealtionshipType($type) || $this->isSingleRealtionshipType($type);
    }


    private function isManyRealtionshipType(string $type): bool
    {
        return in_array($type, [
            HasMany::class,
            BelongsToMany::class,
            HasManyThrough::class,
            MorphMany::class,
            MorphToMany::class,
        ]);
    }


    private function isSingleRealtionshipType(string $type): bool
    {
        return in_array($type, [
            HasOne::class,
            BelongsTo::class,
            MorphOne::class,
            HasOneThrough::class,
        ]);
    }
}
