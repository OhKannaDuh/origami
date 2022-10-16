<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\AdvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_book_id
 * @property int $advantage_type_id
 * @property int $ring_id
 * @property string $key
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property SourceBook $sourceBook
 * @property AdvantageType $advantageType
 * @property Ring $ring
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
}
