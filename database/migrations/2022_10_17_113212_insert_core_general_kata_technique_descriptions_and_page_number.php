<?php

use App\Repositories\Character\TechniqueRepositoryInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\App;

return new class extends Migration
{
    private TechniqueRepositoryInterface $techniques;


    public function __construct()
    {
        $this->techniques = App::make(TechniqueRepositoryInterface::class);
    }


    /**
     * @return void
     */
    public function up(): void
    {
        $this->techniques->getByKey('battle_in_the_mind')->update([
            'description' => [
                'activation' => 'When you make an Initiative check for a duel using your Void Ring, you may spend {{opportunity}} in the following way:',
                'effect' => '**Void {{opportunity}}{{opportunity}}:** You name two rings, then your opponent must name one of those two rings. When your opponent selects their stance during their first turn of the duel, they cannot select the ring they named as their stance.<br/>**Void {{opportunity}}+:** Choose a technique category. Learn one of your opponent\'s known techniques of that category (chosen by the opponent) per {{opportunity}} spent this way.',
            ],
            'page_number' => 174,
        ]);

        $this->techniques->getByKey('breath_of_wind_style')->update([
            'description' => [
                'activation' => 'When you make a Martial Arts [Melee, Ranged, or Unarmed] (Air) check, you may spend {{opportunity}} in the following way:',
                'effect' => '**Air {{opportunity}}+:** One target of your action must resist with a **TN 3 Fitness check (Earth 4, Fire 1)** or suffer the Disoriented condition and fatigue equal to their shortfall. Increase the TN of the check to resist by 1 per {{opportunity}} spent this way.',
            ],
            'page_number' => 175,
        ]);

        $this->techniques->getByKey('crashing_wave_style')->update([
            'description' => [
                'activation' => 'When you make a Martial Arts [Melee , Ranged, or Unarmed] (Water) check, you may spend {{opportunity}} in the following way:',
                'effect' => '**Water {{opportunity}}:** One target of your action must resist with a TN 3 Fitness check (Earth 1, Fire 4) or suffer the Bleeding condition and fatigue equal to their shortfall. Increase the TN of the check to resist by 1 per {{opportunity}} spent this way.',
            ],
            'page_number' => 175,
        ]);

        $this->techniques->getByKey('crescent_moon_style')->update([
            'description' => [
                'activation' => 'When you perform Guard action, you may spend {{opportunity}}, in the following way:',
                'effect' => '**{{opportunity}}:** After a character at range 1-2 performs an Attack action targeting you or another character you are guarding, you may perform a Strike action with one readied Martial Arts [Melee or Unarmed] weapon targeting that character (if they are w ith in your weapon\'s range). This effect persists until the start of your next turn, or until you perform a Strike action this way.',
            ],
            'page_number' => 175,
        ]);

        $this->techniques->getByKey('crimson_leaves_strike')->update([
            'description' => [
                'activation' => 'As an Attack action using a readied weapon, you may make a **TN 4 Martial Arts (Earth) check** with appropriate skill for that weapon, targeting one character within the weapon\'s range.',
                'effect' => 'If you succeed, your target suffers physical damage equal to your Earth Ring, plus additional damage equal to your bonus successes. Choose one of your target\'s readied weapons; the target must resist with a **TN 4 Fitness check (Air 2, Water 5)** or lose control of the chosen weapon, which travels 3 range bands in a direction of your choice.',
            ],
            'page_number' => 175,
        ]);

        $this->techniques->getByKey('disappearing_world_style')->update([
            'description' => [
                'activation' => 'When you make a Martial Arts [Melee, Ranged, or Unarmed] (Fire) check, you may spend {{opportunity}} in the follow ing way:',
                'effect' => '**Fire {{opportunity}}+:** One target of your action must resist with a **TN 3 Fitness check (Air 4, Water 1)** or suffer the Dazed condition and fatigue equal to their shortfall. Increase the TN of the check to resist by 1 per {{opportunity}} spent this way.',
            ],
            'page_number' => 175,
        ]);

        $this->techniques->getByKey('flowing_water_strike')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
            ],
            'page_number' => 175,
        ]);

        $this->techniques->getByKey('heartpiercing_strike')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('iron_in_the_mountains_style')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('lord_hidas_grip')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('lord_shibas_valor')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('soaring_slice')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('soul_sunder')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('striking_as_air')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('striking_as_earth')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('striking_as_fire')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('striking_as_void')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('striking_as_water')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('tactical_assessment')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);

        $this->techniques->getByKey('warriors_resolve')->update([
            'description' => [
                'activation' => '',
                'effect' => '',
                'opportunities' => [],
            ],
        ]);
    }
};
