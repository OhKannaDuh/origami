<?php

namespace App\Models\Core;

use App\Behaviours\HasRepository;
use App\Models\Character\Advantage;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $image
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_official
 *
 * @property Collection<Clan> $clans
 * @property Collection<Family> $families
 * @property Collection<Technique> $techniques
 * @property Collection<Item> $items
 * @property Collection<School> $schools
 * @property Collection<Advantage> $advantages
 * @property Collection<Disadvantage> $disadvantages
 */
final class SourceBook extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'key',
        'name',
        'is_official',
        'image',
    ];

    protected $casts = [
        'is_official' => 'boolean',
    ];


    public function clans(): HasMany
    {
        return $this->hasMany(Clan::class);
    }


    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }


    public function techniques(): HasMany
    {
        return $this->hasMany(Technique::class);
    }


    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }


    public function schools(): HasMany
    {
        return $this->hasMany(School::class);
    }


    public function advantages(): HasMany
    {
        return $this->hasMany(Advantage::class);
    }


    public function disadvantages(): HasMany
    {
        return $this->hasMany(Disadvantage::class);
    }
}
