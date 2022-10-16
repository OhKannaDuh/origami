<?php

use App\Repositories\Character\TechniqueRepositoryInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private TechniqueRepositoryInterface $techniques;


    public function __construct()
    {
        $this->techniques = App::make(TechniqueRepositoryInterface::class);
    }


    public function up(): void
    {
        Schema::table('techniques', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('techniques', function (Blueprint $table) {
            $table->json('description')->default('{}')->after('rank');
        });

        // Saito
        $this->techniques->getByKey('armor_of_earth')->update([
            'description' => [
                'activation' => 'As a Support action, you may make a **TN 2 Theology (Earth) check** targeting yourself.',
                'effect' => 'You summon and equip a suit of armor that grants physical resistance equal to your Earth Ring plus your bonus successes and has the Cumbersome and Wargear qualities. The armor persists for a number of rounds equal to your Earth Ring, at which point it tumbles to the ground as loose stones or dirt.',
                'opportunities' => [
                    [
                        'cost' => 'Earth {{opportunity}}',
                        'effect' => 'This effect persists until the end of the scene instead.',
                    ],
                    [
                        'cost' => 'Earth {{opportunity}}',
                        'effect' => 'The armor you summon has the Durable quality.',
                    ],
                    [
                        'cost' => 'Earth {{opportunity}}{{opportunity}}',
                        'effect' => 'The armor you summon has the Sacred quality.',
                    ],
                ],
            ],
        ]);

        $this->techniques->getByKey('jade_strike')->update([
            'description' => [
                'activation' => 'As an Attack action, you may make a **TN 2 theology (Earth) check** targeting one character at range 0-3.',
                'effect' => 'If you succeed and the target is an Otherworldly being, you smite and purify it with searing jade energy. It suffers a critical strike with severity equal to your Earth Ring plus your bonus successes. The creature may spend {{opportunity}}{{opportunity}} from its check to resist this critical strike to conceal that it has been affected, potentially concealing its Otherworldly nature (though it still suffers the effect that it successfully hid).<br>If you succeed and your target is not a an Otherworldly being, it suffers no ill effect.',
                'opportunities' => [
                    [
                        'cost' => 'Earth {{opportunity}}',
                        'effect' => 'If you succeed, each target that is an Otherworldly being suffers the Silenced condition and cannot use maho techniques until the end of your next turn.',
                    ],
                ],
            ],
        ]);

        $this->techniques->getByKey('striking_as_earth')->update([
            'description' => [
                'activation' => 'When you make a **Martial Arts [Melee, Ranged, or Unarmed] (Earth) check** , you may spend {{opportunity}} in the following way:',
                'effect' => '**Earth {{opportunity}}+:** Treat your physical resistance as 1 higher per {{opportunity}} spent this way until the beginning of your next turn.',
            ],
        ]);

        $this->techniques->getByKey('bind_the_shadow')->update([
            'description' => [
                'activation' => 'As an Attack action, you may make a **TN 3 Theology (Earth) check** targeting one Otherworldly being at range 0-2.',
                'effect' => 'If you succeed, crackling arcs of jade light smite and purify your target; it must resist with a **TN 4 Fitness (Air 2, Water 5) check** or suffer the Immobilized and Silenced conditions. This effect persists for a number of rounds equal to your Earth Ring.',
                'opportunities' => [
                    [
                        'cost' => 'Earth {{opportunity}}',
                        'effect' => 'Each target that fails its Fitness check to resist is bound until the end of the scene instead.',
                    ],
                    [
                        'cost' => 'Earth {{opportunity}}{{opportunity}}',
                        'effect' => 'Each target that fails its Fitness check to resist is bound for one year instead.',
                    ],
                    [
                        'cost' => 'Earth {{opportunity}}{{opportunity}}+',
                        'effect' => 'Increase the TN of checks to resist this effect by 1 per {{opportunity}}{{opportunity}} spent this way',
                    ],
                    [
                        'cost' => 'Earth {{opportunity}}{{opportunity}}{{opportunity}}{{opportunity}}',
                        'effect' => 'Each target that fails its Fitness check to resist is bound for one hundred years instead .',
                    ],
                ],
            ],
        ]);

        // Yu
        $this->techniques->getByKey('ki_protection')->update([
            'description' => [
                'activation' => 'As a Movement and Support action , you may make a **TN 1 Meditation (Water) check**. You may choose one character at range 0-1 as the target for the burst effect.',
                'enhancement' => 'If you succeed, this kiho activates . While this kiho is active, when you perform the Calming Breath action, you may remove 2 fatigue instead of 1.<br>While this kiho is active, after you perform an action, you may spend 1 Void point to remove fatigue equal to your ranks in Medicine from one other character at range 0-1.',
                'burst' => 'If you have 2 or more bonus successes, your target removes fatigue equal to your ranks in Medicine plus your bonus successes. Each target cannot be affected by this effect again until the end of the scene.',
            ],
        ]);

        $this->techniques->getByKey('lord_togashis_insight')->update([
            'description' => [
                'activation' => 'Once per game session as an action, you may make a **TN 2 Meditation (Void) check to seek cosmic wisdom regarding a quandary in front of you.',
                'effect' => 'If you succeed, you receive a brief vision or hear the voice of Togashi providing a hint regarding one way you might proceed (which the GM should furnish). This hint should not be the full answer, but it should help you move forward toward a solution or at least formulate a plan of action.',
                'opportunities' => [
                    [
                        'cost' => 'Void {{opportunity}}',
                        'effect' => 'Reduce the TN of your first check to overcome the problem you are facing by your school rank (to a minimum of 1).',
                    ],
                ],
            ],
        ]);

        $this->techniques->getByKey('way_of_the_earthquake')->update([
            'description' => [
                'activation' => 'As an Attack and Support action, you may make a **TN 2 Martial Arts [Unarmed] (Earth)** check to control the earth around you. When you perform this action, you may choose any number of other characters at range 0-1 as targets for the burst effect.',
                'enhancement' => 'If you succeed, this kiho activates. While this kiho is active, after you perform an Attack or Support action, or defend against damage, you may choose one other character at range 0-2 who must resist with a **TN 4 Fitness check (Air 2, Water 5)** or suffer physical damage equal to your Earth Ring and the Prone condition.',
                'burst' => 'If you have two or more bonus successes, each target suffers physical damage equal to your Earth Ring. Each Prone target suffers physical damage equal to your Earth Ring plus your bonus successes and the Immobilized condition instead.',
            ],
        ]);

        $this->techniques->getByKey('breaking_blow')->update([
            'description' => [
                'activation' => 'As an Attack and Support action, you may make a **TN 1 Martial Arts [Unarmed] (Fire)** check to enhance you run armed blows. When you perform this action, you may choose one object at range 0-1 as the target for the burst effect.',
                'enhancement' => 'If you succeed, this kiho activates. While this kiho is active, when you succeed at a Martial Arts [Unarmed] check against a target, choose one worn piece of armor or readied weapon in one target\'s possession. It gains the Damaged quality(see page 240) unless the target chooses to receive 2 fatigue.',
                'burst' => 'If you have two or more bonus successes, the chosen object gains the Damaged quality (see page 240). At the GM\'s discretion, this can also be used to shatter tough mundane objects, such as wooden doors, earthen walls, and trees.<br/>If you have four or more bonus successes, the chosen object gains the Destroyed quality in stead. At the GM\'s discretion, this can be used to destroy even reinforced mundane objects, such as metal doors and stone walls.',
            ],
        ]);

        $this->techniques->getByKey('breaking_blow')->update([
            'description' => [
                'activation' => 'As a Support action, you may activate this kibo. When you do so, you may make a **TN 1 Meditation (Earth) check** to gain an awareness of your surroundings.',
                'enhancement' => 'If you succeed, this kiho activates. While this kiho is active, you can use vibrations through the earth to "see" a number of ranged bands in all directions equal to your Earth Ring. While this kiho is active increase your vigilance by your Earth Ring.',
                'burst' => 'If you succeed with three or more bonus successes, you instantly become aware of all living creatures and objects touching the ground within a number of range bands equal to your Earth Ring plus your bonus successes.',
            ],
        ]);

        // Ine
        $this->techniques->getByKey('striking_as_air')->update([
            'description' => [
                'activation' => 'When you make a **Martial Arts [Melee, Ranged, or Unarmed] (Air) check** , you may spend {{opportunity}} in the following way:',
                'effect' => '**Air {{opportunity}}+:** Reserve one of your rolled dice, plus one additional die per {{opportunity}}{{opportunity}} spent this way. These dice become dropped dice. When making a check with the same skill before the end of your next turn, you may roll one fewer {{ring-die}} per reserved {{ring-die}} and one fewer {{skill-die}} per reserved {{skill-die}}, then add the reserved dice to your roll. These dice count as rolled dice, but are added set to the results they had when they were reserved.',
            ],
        ]);

        $this->techniques->getByKey('trip_the_leg')->update([
            'description' => [
                'activation' => 'As an Attack action using one readied polearm, you may make a **TN 2 Martial Arts [Melee] check** targeting one character at range 1-2.',
                'effect' => 'If you succeed, your target suffers the Prone condition.',
                'opportunities' => [
                    [
                        'cost' => '{{opportunity}}',
                        'effect' => 'If you succeed, the target receives 2 fatigue and 2 strife',
                    ],
                    [
                        'cost' => '{{opportunity}}+',
                        'effect' => ' If your target’s vigilance is lower than or equal to {{opportunity}} spent this way, they suffer the Disoriented condition.',
                    ],
                ],
            ],
        ]);
    }
};
