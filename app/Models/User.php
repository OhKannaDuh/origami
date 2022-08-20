<?php

namespace App\Models;

use App\Behaviours\HasRepository;
use App\Models\Character\Character;
use App\Models\Core\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<Character> $characters
 * @property Collection<Campaign> $ownedCampaigns
 * @property Collection<Campaign> $campaigns
 */
final class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasRepository;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }


    public function ownedCampaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }


    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'campaign_user');
    }


    public function getAvatarUrl(): string
    {
        $hash = md5(strtolower($this->email));

        return 'https://www.gravatar.com/avatar/' . $hash;
    }
}
