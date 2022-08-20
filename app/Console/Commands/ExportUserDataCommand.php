<?php

namespace App\Console\Commands;

use App\Repositories\Character\CharacterRepositoryInterface;
use App\Repositories\Core\CampaignRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Console\Command;

final class ExportUserDataCommand extends Command
{
    /** @inheritDoc */
    protected $name = 'user:export';

    /** @inheritDoc */
    protected $description = 'Export user generated content to a json file.';


    /**
     * @return bool
     */
    public function handle(
        UserRepositoryInterface $users,
        CampaignRepositoryInterface $campaigns,
        CharacterRepositoryInterface $characters,
    ): bool {
        $data = [
            'users' => $users->all()->makeVisible(['password']),
            'campaigns' => $campaigns->all()->load(['characters', 'users']),
            'characters' => $characters->all()->load(['advantages', 'disadvantages', 'techniques']),
        ];

        file_put_contents(base_path('data/exports/user-content.json'), json_encode($data, JSON_PRETTY_PRINT));

        return true;
    }
}
