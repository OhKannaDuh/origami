<?php

namespace App\Models\Core;

use App\Behaviours\HasRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $technique_type_id
 * @property string $key
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property TechniqueType $techniqueType
 */
final class TechniqueSubtype extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'technique_type_id',
        'name',
        'key',
    ];


    public function techniqueType(): BelongsTo
    {
        return $this->belongsTo(TechniqueType::class);
    }
}
