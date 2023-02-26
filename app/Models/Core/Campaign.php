<?php

namespace App\Models\Core;

use App\Behaviours\HasRepository;
use App\Models\Character\Advantage;
use App\Models\Character\Character;
use App\Models\Character\Disadvantage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property string $npcs
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Character> $characters
 * @property Collection<User> $users
 */
final class Campaign extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'user_id',
        'npcs',
    ];


    public function getRouteKeyName()
    {
        return 'uuid';
    }


    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class, 'campaign_character');
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'campaign_user');
    }


    public function listAdvantagesAndDisadvantagess(): void
    {
        foreach ($this->characters as $character) {
            assert($character instanceof Character);
            foreach ($character->advantages as $advantage) {
                assert($advantage instanceof Advantage);
                echo $advantage->getKey() . ' - ' . $advantage->name . PHP_EOL;
            }

            foreach ($character->disadvantages as $disadvantage) {
                assert($disadvantage instanceof Disadvantage);
                echo $disadvantage->getKey() . ' - ' . $disadvantage->name . PHP_EOL;
            }
        }
    }
}
