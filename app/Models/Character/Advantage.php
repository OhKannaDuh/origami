<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\AdvantageCategory;
use App\Models\Core\AdvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int $source_book_id
 * @property int $advantage_type_id
 * @property int $ring_id
 * @property string $key
 * @property string $name
 * @property int $page_number
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property SourceBook $sourceBook
 * @property AdvantageType $advantageType
 * @property Ring $ring
 * @property Collection<AdvantageCategory> $advantageCategories
 */
final class Advantage extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'advantage_type_id',
        'ring_id',
        'key',
        'name',
        'page_number',
        'page_number',
    ];


    public function sourceBook(): BelongsTo
    {
        return $this->belongsTo(SourceBook::class);
    }


    public function advantageType(): BelongsTo
    {
        return $this->belongsTo(AdvantageType::class);
    }


    public function ring(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }


    public function advantageCategories(): BelongsToMany
    {
        return $this->belongsToMany(AdvantageCategory::class, 'advantage_advantage_category');
    }
}
