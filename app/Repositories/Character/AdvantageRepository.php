<?php

namespace App\Repositories\Character;

use App\Behaviours\Repositories\HasKeyedModel;
use App\Models\Character\Advantage;
use App\Repositories\BaseRepository;
use App\Repositories\Core\AdvantageTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<Advantage>
 */
final class AdvantageRepository extends BaseRepository implements AdvantageRepositoryInterface
{
    use HasKeyedModel;


    /**
     * @param Advantage $model
     */
    public function __construct(
        private AdvantageTypeRepositoryInterface $types,
        Advantage $model,
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


    public function distinctions(): Collection
    {
        $collection = $this->execute(__FUNCTION__, fn(): Collection => $this->belongsToType('distinction'));
        assert($collection instanceof Collection);

        return $collection;
    }


    public function passions(): Collection
    {
        $collection = $this->execute(__FUNCTION__, fn(): Collection => $this->belongsToType('passion'));
        assert($collection instanceof Collection);

        return $collection;
    }
}
