import { BaseCalculatable } from './BaseCalculatable';

export class ClanRelationship extends BaseCalculatable implements ClanRelationshipData {
    public positive: boolean;
    public skill?: App.Models.Core.Skill | null;

    public constructor(data: ClanRelationshipData) {
        super();

        this.positive = data.positive;
        this.skill = data.skill;
    }

    public getSkillBonuses = (): SkillBonus[] => {
        if (!this.skill || this.positive) {
            return [];
        }

        return [
            {
                skill: this.skill,
                bonus: 1,
            },
        ];
    };

    public getGloryBonuses = (): number[] => {
        if (this.positive) {
            return [5];
        }

        return [];
    };
}
