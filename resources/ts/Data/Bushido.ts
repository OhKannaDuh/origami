import { BaseCalculatable } from './BaseCalculatable';

export class Bushido extends BaseCalculatable implements BushidoData {
    public positive: boolean;
    public skill?: App.Models.Core.Skill | null;

    public constructor(data: BushidoData) {
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

    public getHonorBonuses = (): number[] => {
        if (this.positive) {
            return [10];
        }

        return [];
    };
}
