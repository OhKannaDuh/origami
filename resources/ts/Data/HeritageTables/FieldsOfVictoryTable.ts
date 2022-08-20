import _ from 'lodash';
import { CharacterCreationModels } from '../CharacterCreationModels';
import { HeritageTable } from '../HeritageTable';
import { HeritageTableEffect } from '../HeritageTableEffect';
import { HeritageTableEntry } from '../HeritageTableEntry';

export class FieldsOfVictoryTable extends HeritageTable {
    public constructor(models: CharacterCreationModels) {
        super('Fields of Victory');

        this.addEntry(
            new HeritageTableEntry('Born on the Battlefield')
                .withGlory(-3)
                .withEffect(new HeritageTableEffect(1, 10).withAdvantage(models.getDistinction('indomitable_will')))
        );

        this.addEntry(
            new HeritageTableEntry('Strategic Mastermind')
                .withGlory(5)
                .withHonor(-5)
                .withEffect(new HeritageTableEffect(1, 2).withSkill(models.getSkill('tactics')))
                .withEffect(new HeritageTableEffect(3, 4).withSkill(models.getSkill('command')))
                .withEffect(new HeritageTableEffect(5, 6).withSkill(models.getSkill('government')))
                .withEffect(new HeritageTableEffect(7, 8).withSkill(models.getSkill('culture')))
                .withEffect(new HeritageTableEffect(9, 9).withSkill(models.getSkill('commerce')))
                .withEffect(new HeritageTableEffect(10, 10).withSkill(models.getSkill('theology')))
        );

        this.addEntry(
            new HeritageTableEntry('Victory against the Crane')
                .withGlory(3)
                .withEffect(new HeritageTableEffect(1, 3).withItemType(models.getItemType('weapon')))
                .withEffect(new HeritageTableEffect(4, 6).withItem(models.getItem('games')))
                .withEffect(new HeritageTableEffect(7, 8).withItemType(models.getItemType('personal_effect')))
                .withEffect(new HeritageTableEffect(9, 9).withFluff('A Horse'))
                .withEffect(new HeritageTableEffect(10, 10).withFluff('Some land on crane borders'))
        );

        this.addEntry(
            new HeritageTableEntry('Victory against Invaders')
                .withHonor(3)
                .withEffect(new HeritageTableEffect(1, 2).withSkill(models.getSkill('command')))
                .withEffect(new HeritageTableEffect(3, 4).withSkill(models.getSkill('government')))
                .withEffect(new HeritageTableEffect(5, 6).withSkill(models.getSkill('tactics')))
                .withEffect(new HeritageTableEffect(7, 8).withSkill(models.getSkill('survival')))
                .withEffect(new HeritageTableEffect(9).withSkill(models.getSkill('theology')))
                .withEffect(new HeritageTableEffect(10).withSkill(models.getSkill('meditation')))
        );

        this.addEntry(
            new HeritageTableEntry('Shamed by Defeat')
                .withGlory(-3)
                .withEffect(new HeritageTableEffect(1, 2).withFluff('Skill from school which you have 0 ranks in'))
        );

        this.addEntry(
            new HeritageTableEntry('Blade of 10,000 Batlles')
                .withGlory(3)
                .withEffect(new HeritageTableEffect(10, 10).withItemType(models.getItemType('weapon')))
        );

        this.addEntry(
            new HeritageTableEntry('Lost Heirloom')
                .withHonor(5)
                .withGlory(-3)
                .withEffect(
                    new HeritageTableEffect(1, 2).withFluff(
                        'Choose a weapon to be a lost heirloom, which is now held by some individual or group hostile to you or your clan.'
                    )
                )
        );

        // this.addEntry(
        //     new HeritageTableEntry('Selfless Sentinel')
        //         .withHonor(5)
        //         .withGlory(-3)
        //         .withEffect(new HeritageTableEffect(1, 10).withAdvantage(models.getAdvantages('traditional_adhernt')))
        // );
    }
}
