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
 * @property int $ring_id
 * @property int $skill_id
 * @property string $key
 * @property string $name
 * @property int $status
 * @property bool $is_major
 * @property string $description
 * @property int $page_number
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Ring $ring
 * @property Skill $skill
 */
final class Clan extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'ring_id',
        'skill_id',
        'key',
        'name',
        'status',
        'is_major',
        'description',
        'page_number',
    ];

    protected $casts = [
        'is_major' => 'boolean',
    ];


    public function ring(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }


    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
