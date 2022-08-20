<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_book_id
 * @property int $clan_id
 * @property int $ring_choice_one_id
 * @property int $ring_choice_two_id
 * @property int $skill_one_id
 * @property int $skill_two_id
 * @property string $key
 * @property string $name
 * @property int $glory
 * @property int $starting_wealth
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Clan $clan
 * @property Ring $ringChoiceOne
 * @property Ring $ringChoiceTwo
 * @property Skill $skillOne
 * @property Skill $skillTwo
 */
final class Family extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'clan_id',
        'ring_choice_one_id',
        'ring_choice_two_id',
        'skill_one_id',
        'skill_two_id',
        'key',
        'name',
        'glory',
        'starting_wealth',
        'description',
    ];


    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class);
    }


    public function ringChoiceOne(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }


    public function ringChoiceTwo(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }


    public function skillOne(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }


    public function skillTwo(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
