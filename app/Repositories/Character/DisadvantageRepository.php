<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\Disadvantage;
use App\Repositories\BaseRepository;
use App\Repositories\Core\DisadvantageTypeRepositoryInterface;
use Collator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<Disadvantage>
 */
final class DisadvantageRepository extends BaseRepository implements DisadvantageRepositoryInterface
{
    use HasKeyedModel;


    public function __construct(
        private DisadvantageTypeRepositoryInterface $types,
        Disadvantage $model
    ) {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }


    private function belongsToType(string $type): Collection
    {
        $related = $this->types->getByKey($type);
        return $this->getModel()->query()->whereBelongsTo($related)->get();
    }


    public function adversities(): Collection
    {
        $collection = $this->execute(__FUNCTION__, fn(): Collection => $this->belongsToType('adversity'));
        assert($collection instanceof Collection);

        return $collection;
    }


    public function anxieties(): Collection
    {
        $collection = $this->execute(__FUNCTION__, fn(): Collection => $this->belongsToType('anxiety'));
        assert($collection instanceof Collection);

        return $collection;
    }
}
