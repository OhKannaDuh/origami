<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\DisadvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_book_id
 * @property int $disadvantage_type_id
 * @property int $ring_id
 * @property string $key
 * @property string $name
 * @property int $page_number
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property SourceBook $sourceBook
 * @property DisadvantageType $disadvantageType
 * @property Ring $ring
 */
final class Disadvantage extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'disadvantage_type_id',
        'ring_id',
        'key',
        'name',
        'page_number',
    ];


    public function sourceBook(): BelongsTo
    {
        return $this->belongsTo(SourceBook::class);
    }


    public function disadvantageType(): BelongsTo
    {
        return $this->belongsTo(DisadvantageType::class);
    }


    public function ring(): BelongsTo
    {
        return $this->belongsTo(Ring::class);
    }
}
