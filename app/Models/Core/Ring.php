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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Ring extends Model
{
    use HasFactory;
    use HasRepository;

    public const MODE_NORMAL = 'normal';

    public const MODE_SET_TWO_IN_ONE = 'set_two_in_one';

    public const MODE_ANY_TWO_DIFFERENT = 'any_two_different';

    public const MODE_ANY_TWO_SAME = 'any_two_same';

    public const MODE_SET_ONE_AND_ANY_OTHER = 'set_and_one_other';

    protected $fillable = [
        'name',
        'key',
    ];
}
