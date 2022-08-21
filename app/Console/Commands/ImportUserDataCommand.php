<?php

namespace App\Console\Commands;

use App\Repositories\Character\AdvantageRepositoryInterface;
use App\Repositories\Character\CharacterRepositoryInterface;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use App\Repositories\Character\TechniqueRepositoryInterface;
use App\Repositories\Core\CampaignRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

final class ImportUserDataCommand extends Command
{
    /** @inheritDoc */
    protected $name = 'user:import';

    /** @inheritDoc */
    protected $description = 'Import user generated content from a json file.';


    /**
     * @return bool
     */
    public function handle(
        UserRepositoryInterface $users,
        CampaignRepositoryInterface $campaigns,
        CharacterRepositoryInterface $characters,
        AdvantageRepositoryInterface $advantages,
        DisadvantageRepositoryInterface $disadvantages,
        TechniqueRepositoryInterface $techniques,
    ): bool {
        Model::unguard();
        $contents = file_get_contents(base_path('data/imports/user-content.json'));
        $data = json_decode($contents, true);

        $this->output->writeln('Importing Users');
        $users->importMany($data['users']);

        $this->output->writeln('Importing Characters');
        $characters->importMany($data['characters']);

        foreach ($data['characters'] as $datum) {
            $character = $characters->getByUuid($datum['uuid']);
            $this->output->writeln("  Character: {$datum['uuid']} - {$character->name}");

            $characterAdvantages = [];
            foreach ($datum['advantages'] as $advantage) {
                $characterAdvantages[] = $advantages->getByKey($advantage['key'])->getKey();
            }

            $characterDisadvantages = [];
            foreach ($datum['disadvantages'] as $disadvantage) {
                $characterDisadvantages[] = $disadvantages->getByKey($disadvantage['key'])->getKey();
            }

            $characterTechniques = [];
            foreach ($datum['techniques'] as $technique) {
                $characterTechniques[] = $techniques->getByKey($technique['key'])->getKey();
            }

            $this->output->writeln('    Attaching ' . count($characterAdvantages) . ' Advantage(s)');
            $character->advantages()->attach($characterAdvantages);

            $this->output->writeln('    Attaching ' . count($characterAdvantages) . ' Disadvantage(s)');
            $character->disadvantages()->attach($characterDisadvantages);

            $this->output->writeln('    Attaching ' . count($characterAdvantages) . ' Technique(s)');
            $character->techniques()->attach($characterTechniques);
        }

        $this->output->writeln('Importing Campaigns');
        $campaigns->importMany($data['campaigns']);

        foreach ($data['campaigns'] as $datum) {
            $campaign = $campaigns->getByUuid($datum['uuid']);
            $this->output->writeln("  Campaign: {$datum['uuid']}");

            $campaignCharacters = [];
            foreach ($datum['characters'] as $character) {
                $campaignCharacters[] = $characters->getByUuid($character['uuid'])->getKey();
            }

            $campaignUsers = [];
            foreach ($datum['users'] as $user) {
                $campaignUsers[] = $users->getById($user['id'])->getKey();
            }

            $this->output->writeln('    Attaching Characters');
            $campaign->characters()->attach($campaignCharacters);

            $this->output->writeln('    Attaching Users');
            $campaign->users()->attach($campaignUsers);
        }


        Model::reguard();

        return true;
    }
}
