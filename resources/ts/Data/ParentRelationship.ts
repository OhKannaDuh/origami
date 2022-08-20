import { BaseCalculatable } from './BaseCalculatable';

export class ParentRelationship extends BaseCalculatable implements ParentRelationshipData {
    public description: string;
    public skill?: App.Models.Core.Skill | null;

    public constructor(data: ParentRelationshipData) {
        super();

        this.description = data.description;
        this.skill = data.skill;
    }

    public getSkillBonuses = (): SkillBonus[] => {
        if (!this.skill) {
            return [];
        }

        return [
            {
                skill: this.skill,
                bonus: 1,
            },
        ];
    };
}
