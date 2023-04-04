<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $name
 * @property array $inventory
 * @property int $clan_id
 * @property int $family_id
 * @property int $school_id
 * @property int $school_rank
 * @property string $avatar
 * @property array $advancements
 * @property array $personality
 * @property array $heritage
 * @property array $stats
 * @property bool $allow_nonhuman_techniques
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property Clan $clan
 * @property Family $family
 * @property School $school
 * @property Collection<Advantage> $advantages
 * @property Collection<Disadvantage> $disadvantages
 * @property Collection<Technique> $techniques
 * @property Collection<Campaign> $campaigns
 */
final class Character extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'inventory',
        'clan_id',
        'family_id',
        'school_id',
        'school_rank',
        'avatar',
        'advancements',
        'personality',
        'heritage',
        'stats',
        'allow_nonhuman_techniques',
    ];

    protected $casts = [
        'inventory' => 'json',
        'advancements' => 'json',
        'personality' => 'json',
        'heritage' => 'json',
        'stats' => 'json',
        'allow_nonhuman_techniques' => 'boolean',
    ];


    public function getRouteKeyName()
    {
        return 'uuid';
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class);
    }


    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }


    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


    public function advantages(): BelongsToMany
    {
        return $this->belongsToMany(Advantage::class, 'character_advantage');
    }


    public function disadvantages(): BelongsToMany
    {
        return $this->belongsToMany(Disadvantage::class, 'character_disadvantage');
    }


    public function techniques(): BelongsToMany
    {
        return $this->belongsToMany(Technique::class, 'character_technique');
    }


    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'campaign_character');
    }
}
