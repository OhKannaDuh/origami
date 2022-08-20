<?php

namespace App\Models\Core;

use App\Behaviours\HasRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $item_type_id
 * @property string $key
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property ItemType $itemType
 */
final class ItemSubtype extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'item_type_id',
        'name',
        'key',
    ];


    public function itemType(): BelongsTo
    {
        return $this->belongsTo(ItemType::class);
    }
}
