<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\Ring;
use App\Models\Core\SchoolType;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $source_book_id
 * @property string $key
 * @property string $name
 * @property string $ring_mode
 * @property int|null $ring_one_id
 * @property int|null $ring_two_id
 * @property int $starting_skill_amount
 * @property array $starting_skills
 * @property array $starting_techniques
 * @property array $starting_outfit
 * @property array $curriculum
 * @property int $school_ability_id
 * @property int $mastery_ability_id
 * @property int $family_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $honor
 * @property int $page_number
 *
 * @property SourceBook $sourceBook
 * @property Ring|null $ringOne
 * @property Ring|null $ringTwo
 * @property Family $family
 * @property Collection<TechniqueType> $availableTechniqueTypes
 * @property Collection<TechniqueSubtype> $availableTechniqueSubtypes
 * @property Collection<SchoolType> $schoolTypes
 */
final class School extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'key',
        'name',
        'ring_mode',
        'ring_one_id',
        'ring_two_id',
        'starting_skill_amount',
        'starting_skills',
        'starting_techniques',
        'starting_outfit',
        'curriculum',
        'school_ability_id',
        'mastery_ability_id',
        'family_id',
        'honor',
        'page_number',
    ];

    protected $casts = [
        'starting_skills' => 'array',
        'starting_techniques' => 'json',
        'starting_outfit' => 'json',
        'curriculum' => 'json',
    ];


    public function sourceBook(): BelongsTo
    {
        return $this->belongsTo(SourceBook::class);
    }


    public function ringOne(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }


    public function ringTwo(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }


    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }


    public function availableTechniqueTypes(): BelongsToMany
    {
        return $this->belongsToMany(TechniqueType::class, 'school_technique_type');
    }


    public function availableTechniqueSubtypes(): BelongsToMany
    {
        return $this->belongsToMany(TechniqueSubtype::class, 'school_technique_subtype');
    }


    public function schoolTypes(): BelongsToMany
    {
        return $this->belongsToMany(SchoolType::class, 'school_school_type');
    }
}
