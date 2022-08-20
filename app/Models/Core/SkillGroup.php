<?php

namespace App\Models\Core;

use App\Behaviours\HasRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class SkillGroup extends Model
{
    use HasFactory;
    use HasRepository;

    protected $fillable = [
        'name',
        'key',
        'description',
    ];
}
