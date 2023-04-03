<?php

namespace App\Console\Commands;

use App\Exceptions\FileAlreadyExistsException;
use App\StringHelper;
use Exception;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use UnexpectedValueException;

final class RepositoryMakeCommand extends GeneratorCommand
{
    /** @inheritDoc */
    protected $name = 'make:repository';

    /** @inheritDoc */
    protected $type = 'Repository';

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

        // Repository
        $repository = StringHelper::replace('Models', 'Repositories', $fullyQualifiedModel) . 'Repository';
        $repositoryPath = $this->getPath($repository);
        // Interface
        $interface = $repository . 'Interface';
        $interfacePath = $this->getPath($interface);

        if ($this->files->exists($repositoryPath) && !$force) {
            throw new FileAlreadyExistsException($repositoryPath);
        }

        if ($this->files->exists($interfacePath) && !$force) {
            throw new FileAlreadyExistsException($interfacePath);
        }

        $this->makeDirectory($repositoryPath);

        $repositoryStub = $this->generateRepositoryStub($repository, $fullyQualifiedModel);
        $interfaceStub = $this->generateInterfaceStub($interface, $fullyQualifiedModel);

        $this->output->info('Creating: ' . $repositoryPath);
        $this->files->put($repositoryPath, $repositoryStub);
        $this->output->info('Creating: ' . $interfacePath);
        $this->files->put($interfacePath, $interfaceStub);

        return true;
    }


    /**
     * @param string $repository
     * @param string $fullyQualifiedModel
     *
     * @return string
     */
    private function generateRepositoryStub(string $repository, string $fullyQualifiedModel): string
    {
        $model = StringHelper::afterLast($fullyQualifiedModel, '\\');

        $repositoryStub = $this->files->get(base_path('stubs/repository.stub'));
        $repositoryStub = $this
            ->replaceNamespace($repositoryStub, $repository)
            ->replaceClass($repositoryStub, $repository);
        $repositoryStub = StringHelper::replace('{{ fullyQualifiedModel }}', $fullyQualifiedModel, $repositoryStub);
        $repositoryStub = StringHelper::replace('{{ model }}', $model, $repositoryStub);

        return $this->sortImports($repositoryStub);
    }


    /**
     * @param string $interface
     * @param string $fullyQualifiedModel
     *
     * @return string
     */
    private function generateInterfaceStub(string $interface, string $fullyQualifiedModel): string
    {
        $model = StringHelper::afterLast($fullyQualifiedModel, '\\');

        $interfaceStub = $this->files->get(base_path('stubs/repository-interface.stub'));
        $interfaceStub = $this
            ->replaceNamespace($interfaceStub, $interface)
            ->replaceClass($interfaceStub, $interface);
        $interfaceStub = StringHelper::replace('{{ fullyQualifiedModel }}', $fullyQualifiedModel, $interfaceStub);
        $interfaceStub = StringHelper::replace('{{ model }}', $model, $interfaceStub);

        return $this->sortImports($interfaceStub);
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
}
