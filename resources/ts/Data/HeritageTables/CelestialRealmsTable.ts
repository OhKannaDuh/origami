import _ from 'lodash';
import { CharacterCreationModels } from '../CharacterCreationModels';
import { HeritageTable } from '../HeritageTable';
import { HeritageTableEffect } from '../HeritageTableEffect';
import { HeritageTableEntry } from '../HeritageTableEntry';

export class CelestialRealmsTable extends HeritageTable {
    public constructor(models: CharacterCreationModels) {
        super('Celestial Realms');

        this.addEntry(
            new HeritageTableEntry('Sacrifice')
                .withGlory(5)
                .withEffect(new HeritageTableEffect(1, 3).withItemType(models.getItemType('weapon')))
                .withEffect(new HeritageTableEffect(4, 6).withItemType(models.getItemType('armor')))
                .withEffect(new HeritageTableEffect(7, 8).withFluff('A valued piece of art'))
                .withEffect(new HeritageTableEffect(9).withFluff('A horse or other animal'))
                .withEffect(new HeritageTableEffect(10).withFluff('A boat or Estate'))
        );

        this.addEntry(
            new HeritageTableEntry('Touched by the Fortune')
                .withGlory(-5)
                .withEffect(new HeritageTableEffect(1, 10).withAdvantage(models.getDistinction('sixth_sense')))
        );
    }
}
