import _ from 'lodash';
import { HeritageTableEffect } from './HeritageTableEffect';

export class HeritageTableEntry implements IHeritageTableEntry {
    public name: string;

    public modifiers = {
        glory: 0,
        honor: 0,
        status: 0,
    };

    public effects: HeritageTableEffect[] = [];

    public constructor(name: string) {
        this.name = name;
    }

    public withGlory(modifier: number): HeritageTableEntry {
        this.modifiers.glory = modifier;
        return this;
    }

    public withHonor(modifier: number): HeritageTableEntry {
        this.modifiers.honor = modifier;
        return this;
    }

    public withStatus(modifier: number): HeritageTableEntry {
        this.modifiers.status = modifier;
        return this;
    }

    public withEffect(effect: HeritageTableEffect): HeritageTableEntry {
        this.effects.push(effect);
        return this;
    }

    public hasMultipleEffects = (): boolean => this.effects.length > 1;

    public getEffectChoices(): any[] {
        let choices: any[] = [];
        this.effects.forEach((effect: HeritageTableEffect) => {
            if (effect.advantage) choices.push(effect.advantage);
            if (effect.skill) choices.push(effect.skill);
            if (effect.item) choices.push(effect.item);
            if (effect.item_type) choices.push(effect.item_type);
            if (effect.item_subtype) choices.push(effect.item_subtype);
        });

        return choices;
    }
}
