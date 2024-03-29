<?php

namespace App\Models\Character;

use App\Behaviours\HasRepository;
use App\Models\Core\ItemSubtype;
use App\Models\Core\SourceBook;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_book_id
 * @property int $item_subtype_id
 * @property string $key
 * @property string $name
 * @property string $description
 * @property array $data
 * @property array $cost
 * @property int $rarity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $page_number
 *
 * @property SourceBook $sourceBook
 * @property ItemSubtype $itemSubtype
 */
final class Item extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'source_book_id',
        'item_subtype_id',
        'key',
        'name',
        'description',
        'data',
        'cost',
        'rarity',
        'page_number',
    ];

    protected $casts = [
        'data' => 'json',
        'cost' => 'json',
    ];


    public function sourceBook(): BelongsTo
    {
        return $this->belongsTo(SourceBook::class);
    }


    public function itemSubtype(): BelongsTo
    {
        return $this->belongsTo(ItemSubtype::class);
    }
}
