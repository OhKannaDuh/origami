<?php

namespace Tests\Unit\Behaviours\HasRepository;

use App\Behaviours\HasRepository;
use App\Models\Core\Campaign;
use App\Repositories\Core\CampaignRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class ModelWithNewRepository extends Model
{
    use HasRepository;


    private static function newRepository(): RepositoryInterface
    {
        return new CampaignRepository(new Campaign());
    }
}
