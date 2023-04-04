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
 * @property bool $is_nonhuman
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
        'key',
        'name',
        'is_nonhuman',
    ];

    protected $casts = [
        'is_nonhuman' => 'boolean',
    ];


    public function techniqueType(): BelongsTo
    {
        return $this->belongsTo(TechniqueType::class);
    }
}
