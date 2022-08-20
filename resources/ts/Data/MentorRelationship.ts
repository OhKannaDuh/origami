import { BaseCalculatable } from './BaseCalculatable';

export class MentorRelationship extends BaseCalculatable implements MentorRelationshipData {
    public description: string;
    public advantage?: App.Models.Character.Advantage | null;
    public skill?: App.Models.Core.Skill | null;
    public disadvantage?: App.Models.Character.Disadvantage | null;

    public constructor(data: MentorRelationshipData) {
        super();

        this.description = data.description;
        this.advantage = data.advantage;
        this.skill = data.skill;
        this.disadvantage = data.disadvantage;
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

    public getDistinctions = (): App.Models.Character.Advantage[] => {
        if (this.advantage && this.advantage.advantage_type?.key === 'distinction') {
            return [this.advantage];
        }

        return [];
    };

    public getPassions = (): App.Models.Character.Advantage[] => {
        if (this.advantage && this.advantage.advantage_type?.key === 'passion') {
            return [this.advantage];
        }

        return [];
    };

    public getAdversities = (): App.Models.Character.Disadvantage[] => {
        if (this.disadvantage && this.disadvantage.disadvantage_type?.key === 'adversities') {
            return [this.disadvantage];
        }

        return [];
    };

    public getAnxieties = (): App.Models.Character.Disadvantage[] => {
        if (this.disadvantage && this.disadvantage.disadvantage_type?.key === 'anxieties') {
            return [this.disadvantage];
        }

        return [];
    };
}
