import _ from 'lodash';
import { CharacterCreationModels } from '../CharacterCreationModels';
import { HeritageTable } from '../HeritageTable';
import { HeritageTableEffect } from '../HeritageTableEffect';
import { HeritageTableEntry } from '../HeritageTableEntry';

export class CoreRulebookTable extends HeritageTable {
    public constructor(models: CharacterCreationModels) {
        super('Core Rulebook');

        this.addEntry(
            new HeritageTableEntry('Famous Deed')
                .withGlory(3)
                .withEffect(new HeritageTableEffect(1, 3).withItemType(models.getItemType('weapon')))
                .withEffect(new HeritageTableEffect(4, 6).withItemType(models.getItemType('armor')))
                .withEffect(new HeritageTableEffect(7, 8).withItemType(models.getItemType('personal_effect')))
                .withEffect(new HeritageTableEffect(9).withFluff('A horse or other animal'))
                .withEffect(new HeritageTableEffect(10).withFluff('A boat or Estate'))
        );

        this.addEntry(
            new HeritageTableEntry('Glorious Sacrifice')
                .withHonor(5)
                .withGlory(5)
                .withEffect(new HeritageTableEffect(1, 3).withFluff('A weapon'))
                .withEffect(new HeritageTableEffect(4, 6).withFluff('A set of Armor'))
                .withEffect(new HeritageTableEffect(7, 8).withFluff('Another item'))
                .withEffect(new HeritageTableEffect(9).withFluff('A horse or other animal'))
                .withEffect(new HeritageTableEffect(10).withFluff('A boat or Estate'))
        );

        this.addEntry(
            new HeritageTableEntry('Wondrous Work')
                .withGlory(5)
                .withEffect(new HeritageTableEffect(1, 3).withSkill(models.getSkill('aesthetics')))
                .withEffect(new HeritageTableEffect(4, 6).withSkill(models.getSkill('composition')))
                .withEffect(new HeritageTableEffect(7, 8).withSkill(models.getSkill('design')))
                .withEffect(new HeritageTableEffect(9, 10).withSkill(models.getSkill('smithing')))
        );

        this.addEntry(
            new HeritageTableEntry('Dynasty Builder')
                .withGlory(-3)
                .withEffect(new HeritageTableEffect(1, 3).withSkill(models.getSkill('command')))
                .withEffect(new HeritageTableEffect(4, 6).withSkill(models.getSkill('courtesy')))
                .withEffect(new HeritageTableEffect(7, 8).withSkill(models.getSkill('games')))
                .withEffect(new HeritageTableEffect(9, 10).withSkill(models.getSkill('performance')))
        );

        this.addEntry(
            new HeritageTableEntry('Discovery')
                .withGlory(3)
                .withEffect(new HeritageTableEffect(1, 3).withSkill(models.getSkill('culture')))
                .withEffect(new HeritageTableEffect(4, 5).withSkill(models.getSkill('sentiment')))
                .withEffect(new HeritageTableEffect(6, 7).withSkill(models.getSkill('government')))
                .withEffect(new HeritageTableEffect(8, 9).withSkill(models.getSkill('medicine')))
                .withEffect(new HeritageTableEffect(10).withSkill(models.getSkill('theology')))
        );

        this.addEntry(
            new HeritageTableEntry('Ruthless Victory')
                .withHonor(-5)
                .withEffect(new HeritageTableEffect(1, 3).withSkill(models.getSkill('fitness')))
                .withEffect(new HeritageTableEffect(4, 5).withSkill(models.getSkill('martial_arts_melee')))
                .withEffect(new HeritageTableEffect(6, 7).withSkill(models.getSkill('martial_arts_ranged')))
                .withEffect(new HeritageTableEffect(8).withSkill(models.getSkill('martial_arts_unarmed')))
                .withEffect(new HeritageTableEffect(9).withSkill(models.getSkill('tactics')))
                .withEffect(new HeritageTableEffect(10).withSkill(models.getSkill('meditation')))
        );

        this.addEntry(
            new HeritageTableEntry('Elevated to Service')
                .withGlory(-3)
                .withHonor(3)
                .withEffect(new HeritageTableEffect(1, 3).withSkill(models.getSkill('commerce')))
                .withEffect(new HeritageTableEffect(4, 5).withSkill(models.getSkill('labor')))
                .withEffect(new HeritageTableEffect(6, 7).withSkill(models.getSkill('seafaring')))
                .withEffect(new HeritageTableEffect(8).withSkill(models.getSkill('skulduggery')))
                .withEffect(new HeritageTableEffect(9, 10).withSkill(models.getSkill('survival')))
        );

        this.addEntry(
            new HeritageTableEntry('Stolen Knowledge')
                .withHonor(-5)
                .withEffect(new HeritageTableEffect(1, 3).withTechniqueType(models.getTechniqueType('kata')))
                .withEffect(new HeritageTableEffect(4, 6).withTechniqueType(models.getTechniqueType('shuji')))
                .withEffect(new HeritageTableEffect(7).withTechniqueType(models.getTechniqueType('rituals')))
                .withEffect(new HeritageTableEffect(8).withTechniqueType(models.getTechniqueType('invocations')))
                .withEffect(new HeritageTableEffect(9).withTechniqueType(models.getTechniqueType('kiho')))
                .withEffect(new HeritageTableEffect(10).withTechniqueType(models.getTechniqueType('maho')))
        );

        this.addEntry(
            new HeritageTableEntry('Imperial Heritage')
                .withStatus(10)
                .withEffect(new HeritageTableEffect(1, 10).withAdvantage(models.getDistinction('blessed_lineage')))
        );

        this.addEntry(
            new HeritageTableEntry('Unusual Name Origin').withGlory(-3).withEffect(new HeritageTableEffect(1, 10).withFluff(':) Implement this later'))
        );
    }
}
