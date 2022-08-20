<?php

namespace Database\Seeders\SourceBooks\Core;

use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class SchoolSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        (new Schools\Crab\HidaDefenderSchoolSeeder($sourceBook))->run();
        (new Schools\Crab\HirumaScoutSchoolSeeder($sourceBook))->run();
        (new Schools\Crab\KaiuEngineerSchoolSeeder($sourceBook))->run();
        (new Schools\Crab\KuniPurifierSchoolSeeder($sourceBook))->run();
        (new Schools\Crab\YasukiMerchantSchoolSeeder($sourceBook))->run();

        (new Schools\Crane\AsahinaArtificerSchoolSeeder($sourceBook))->run();
        (new Schools\Crane\DaidojiIronWarriorSchoolSeeder($sourceBook))->run();
        (new Schools\Crane\DojiDiplomatSchoolSeeder($sourceBook))->run();
        (new Schools\Crane\KakitaDuelistSchoolSeeder($sourceBook))->run();

        (new Schools\Dragon\AgashaMysticSchoolSeeder($sourceBook))->run();
        (new Schools\Dragon\KitsukiInverstigatorSchoolSeeder($sourceBook))->run();
        (new Schools\Dragon\MirumotoTwoHeavensAdeptSchoolSeeder($sourceBook))->run();
        (new Schools\Dragon\TogashiTatooedOrderSeeder($sourceBook))->run();

        (new Schools\Lion\AkodoCommanderSchoolSeeder($sourceBook))->run();
        (new Schools\Lion\IkomaBardSchoolSeeder($sourceBook))->run();
        (new Schools\Lion\KitsuMediumSchoolSeeder($sourceBook))->run();
        (new Schools\Lion\MatsuBerserkerSchoolSeeder($sourceBook))->run();

        (new Schools\Phoenix\AsakoLoremasterSchoolSeeder($sourceBook))->run();
        (new Schools\Phoenix\IsawaElementalistSchoolSeeder($sourceBook))->run();
        (new Schools\Phoenix\KaitoShrineKeeperSchoolSeeder($sourceBook))->run();
        (new Schools\Phoenix\ShibaGuardianSchoolSeeder($sourceBook))->run();

        (new Schools\Scorpion\BayushiManipulatorSchoolSeeder($sourceBook))->run();
        (new Schools\Scorpion\ShosuroInfiltratorSchoolSeeder($sourceBook))->run();
        (new Schools\Scorpion\SoshiIllusionistSchoolSeeder($sourceBook))->run();
        (new Schools\Scorpion\YogoWardmasterSchoolSeeder($sourceBook))->run();

        (new Schools\Unicorn\IdeTraderSchoolSeeder($sourceBook))->run();
        (new Schools\Unicorn\IuchiMeishodoMasterSchoolSeeder($sourceBook))->run();
        (new Schools\Unicorn\MotoConquerorSchoolSeeder($sourceBook))->run();
        (new Schools\Unicorn\ShinjoOutriderSchoolSeeder($sourceBook))->run();
        (new Schools\Unicorn\UtakuBattleMaidenSchoolSeeder($sourceBook))->run();
    }
}
