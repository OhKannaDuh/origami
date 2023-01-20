<?php

namespace App\Repositories\Character;

use App\Models\Character\Character;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseRepository<Character>
 */
final class CharacterRepository extends BaseRepository implements CharacterRepositoryInterface
{


    /**
     * @param Character $model
     */
    public function __construct(Character $model)
    {
        $this->model = $model;
    }


    protected function getCreateRules(array $input): array
    {
        return [];
    }


    public function getByUuid(string $uuid, array $columns = ['*']): Character
    {
        $character = $this->execute(__FUNCTION__, fn(): Model => $this->getModel()->query()->where('uuid', $uuid)->firstOrFail($columns), [
            'uuid' => $uuid,
        ]);

        assert($character instanceof Character);

        return $character;
    }


    public function updateStats(Character $character, array $stats): bool
    {
        return $this->execute(__FUNCTION__, fn(): bool => $character->update([
            'stats' => $stats,
        ]));
    }
}
