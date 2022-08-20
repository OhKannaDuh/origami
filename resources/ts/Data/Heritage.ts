import { BaseCalculatable } from './BaseCalculatable';
import { HeritageTableEffect } from './HeritageTableEffect';
import { HeritageTableEntry } from './HeritageTableEntry';

export class Heritage extends BaseCalculatable {
    public entry: HeritageTableEntry | null = null;
    public effect: HeritageTableEffect | null = null;
    public item: App.Models.Character.Item | null = null;
    public technique: App.Models.Character.Technique | null = null;

    public constructor() {
        super();
    }

    public getHonorBonuses = (): number[] => [this.entry?.modifiers.honor ?? 0];
    public getGloryBonuses = (): number[] => [this.entry?.modifiers.glory ?? 0];
    public getStatusBonuses = (): number[] => [this.entry?.modifiers.status ?? 0];

    public getItems = (): App.Models.Character.Item[] => {
        if (!this.item) {
            return [];
        }

        return [this.item];
    };

    public getDistinctions = (): App.Models.Character.Advantage[] => {
        if (!this.effect || !this.effect.advantage) {
            return [];
        }

        if (this.effect.advantage.advantage_type?.key !== 'distinction') {
            return [];
        }

        return [this.effect.advantage];
    };

    public getPassions = (): App.Models.Character.Advantage[] => {
        if (!this.effect || !this.effect.advantage) {
            return [];
        }

        if (this.effect.advantage.advantage_type?.key !== 'pasion') {
            return [];
        }

        return [this.effect.advantage];
    };

    public getSkillBonuses = (): SkillBonus[] => {
        if (!this.effect || !this.effect.skill) {
            return [];
        }

        return [
            {
                skill: this.effect.skill,
                bonus: 1,
            },
        ];
    };
}
