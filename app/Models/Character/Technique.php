<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\TechniqueSubtype;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_book_id
 * @property int $technique_subtype_id
 * @property string $key
 * @property string $name
 * @property int $rank
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property TechniqueSubtype $techniqueSubtype
 */
final class Technique extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'technique_subtype_id',
        'key',
        'name',
        'rank',
        'description',
    ];


    public function techniqueSubtype(): BelongsTo
    {
        return $this->belongsTo(TechniqueSubtype::class);
    }
}
