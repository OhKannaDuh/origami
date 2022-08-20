<?php

namespace App\Models\Core;

use App\Behaviours\HasRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $skill_group_id
 * @property string $key
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property SkillGroup $skillGroup
 */
final class Skill extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'skill_group_id',
        'key',
        'name',
        'description',
    ];


    public function skillGroup(): BelongsTo
    {
        return $this->belongsTo(SkillGroup::class);
    }
}
