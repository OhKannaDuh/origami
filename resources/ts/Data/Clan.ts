import { BaseCalculatable } from "./BaseCalculatable";

export class Clan extends BaseCalculatable implements App.Models.Character.Clan {
    public id: number;
    public source_book_id: number;
    public ring_id: number;
    public skill_id: number;
    public key: string;
    public name: string;
    public status: number;
    public description: string;
    public created_at: string | null;
    public updated_at: string | null;
    public ring?: App.Models.Core.Ring | null | undefined;
    public skill?: App.Models.Core.Skill | null | undefined;

    public constructor(clan: App.Models.Character.Clan) {
        super();

        this.id = clan.id;
        this.source_book_id = clan.source_book_id;
        this.ring_id = clan.ring_id;
        this.skill_id = clan.skill_id;
        this.key = clan.key;
        this.name = clan.name;
        this.status = clan.status;
        this.description = clan.description;
        this.created_at = clan.created_at;
        this.updated_at = clan.updated_at;
        this.ring = clan.ring;
        this.skill = clan.skill;
    }

    public getRingBonuses = (): RingBonus[] => {
        if (!this.ring) {
            return [];
        }

        return [
            {
                ring: this.ring,
                bonus: 1,
            }
        ];
    }

    public getSkillBonuses = (): SkillBonus[] => {
        if (!this.skill) {
            return [];
        }

        return [
            {
                skill: this.skill,
                bonus: 1,
            }
        ];
    }

    public getStatusBonuses = (): number[] => [this.status];

}
