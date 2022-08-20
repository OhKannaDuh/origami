<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Character\Character;
use App\Models\User;
use App\StringHelper;
use Illuminate\Console\Command;
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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use ReflectionClass;
use ReflectionException;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

use function file_get_contents;
use function json_decode;
use function realpath;

final class AddProprtyDocblockCommand extends Command
{
    /** @var string */
    protected $name = 'docblock:generate';

    /** @var string */
    protected $description = 'Add Model proprty docblocks to <odel classes.';


    public function handle(): bool
    {
        $models = $this->getModelClasses();

        foreach ($models as $class) {
            $reflection = new ReflectionClass($class);

            /** @var Model $model */
            $model = App::make($class);

            if (!$model instanceof Model) {

                continue;
            }

            $table =  $model->getTable();

            /** @var Collection<string, string> $columns */
            $columns = collect(Schema::getColumnListing($table))
                ->mapWithKeys(fn (string $column): array => [$column => Schema::getColumnType($table, $column)]);

            /** @var Collection<string, string> $properties */
            $properties = $columns->map(fn (string$type, string $column): array => [$column => $this->getProprtyType($type, $column, $model)]);

            $docblock = '/**' . PHP_EOL;
            foreach ($properties as $column => $type) {
                $docblock .= ' * @property ' . $type . ' $' . $column . PHP_EOL;
            }

            $relationships = [];
            foreach ($reflection->getMethods() as $method) {
                $type = (string) $method->getReturnType();
                if (!$this->isRealtionshipType($type)) {
                    continue;
                }

                $related = get_class($method->invoke($model)->getRelated());
                $related = StringHelper::afterLast($related, '\\');

                if ($this->isManyRealtionshipType($type)) {
                    $relationships[$method->getName()] = 'Collection<' . $related . '>';
                    continue;
                }

                $relationships[$method->getName()] = $related;
            }

            if (!empty($relationships)) {
                $docblock .= ' *' . PHP_EOL;
                foreach ($relationships as $relationship => $type) {
                    $docblock .= ' * @property ' . $type . ' $' . $relationship . PHP_EOL;
                }
            }

            $docblock .= ' */' . PHP_EOL;

            $line = $reflection->getStartLine();

            $file = $reflection->getFileName();
            $contents = explode("\n", file_get_contents($file));
            $pre = array_splice($contents, 0, $line - 1);

            $comment = $reflection->getDocComment();
            if ($comment) {
                array_splice($pre, -count(explode("\n", $comment)));
            }

            $pre = implode("\n", $pre);
            $pre .= PHP_EOL . $docblock;

            $contents = $pre . implode("\n", $contents);

            file_put_contents($file, $contents);
        }


        return true;
    }


    private function getModelClasses(): Collection
    {
        $composer = json_decode(file_get_contents(realpath('composer.json')));
        return collect($composer->autoload->{'psr-4'})
        ->flatMap(static function (string $path, string $namespace) {
            return collect((new Finder())->in($path)->name('*.php')->files())
                ->map(static function (SplFileInfo $file) use ($path, $namespace) {
                    return $namespace . StringHelper::replace(
                        ['/', '.php'],
                        ['\\', ''],
                        StringHelper::after($file->getRealPath(), realpath($path) . DIRECTORY_SEPARATOR)
                    );
                })
                ->filter(static function (string $className) {
                    try {
                        new ReflectionClass($className);

                        return true;
                    } catch (ReflectionException $e) {
                        return false;
                    }
                })
                ->map(static fn (string $className) => new ReflectionClass($className))
                ->reject(static fn (ReflectionClass $reflection) => $reflection->isAbstract())
                ->values();
        })
        ->groupBy(fn (ReflectionClass $reflection) => $reflection->getNamespaceName())
        ->filter(fn ($collection, $namespace) => StringHelper::contains($namespace, 'Models'))
        ->flatMap(fn(Collection $models) => $models->map(fn($model) => $model->getName()));
    }


    private function getProprtyType(string $type, string $column, Model $model): string
    {
        $casts = $model->getCasts();
        if (array_key_exists($column, $casts)) {
            $type = $casts[$column];
        }

        return match ($type) {
            'bigint', 'integer' => 'int',
            'boolean' => 'bool',
            'datetime' => 'Carbon',
            'json' => 'array',
            'text' => 'string',
            default => $type,
        };
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
