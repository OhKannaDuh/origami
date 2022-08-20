import { BaseCalculatable } from "./BaseCalculatable";

export class Family extends BaseCalculatable implements App.Models.Character.Family {
    public id: number;
    public source_book_id: number;
    public clan_id: number;
    public ring_choice_one_id: number;
    public ring_choice_two_id: number;
    public skill_one_id: number;
    public skill_two_id: number;
    public key: string;
    public name: string;
    public glory: number;
    public starting_wealth: number;
    public description: string;
    public created_at: string | null;
    public updated_at: string | null;
    public clan?: App.Models.Character.Clan | null;
    public ring_choice_one?: App.Models.Core.Ring | null;
    public ring_choice_two?: App.Models.Core.Ring | null;
    public skill_one?: App.Models.Core.Skill | null;
    public skill_two?: App.Models.Core.Skill | null;

    public ring: App.Models.Core.Ring;

    public constructor(family: App.Models.Character.Family, ring: App.Models.Core.Ring) {
        super();

        this.id = family.id;
        this.source_book_id = family.source_book_id;
        this.clan_id = family.clan_id;
        this.ring_choice_one_id = family.ring_choice_one_id;
        this.ring_choice_two_id = family.ring_choice_two_id;
        this.skill_one_id = family.skill_one_id;
        this.skill_two_id = family.skill_two_id;
        this.key = family.key;
        this.name = family.name;
        this.glory = family.glory;
        this.starting_wealth = family.starting_wealth;
        this.description = family.description;
        this.created_at = family.created_at;
        this.updated_at = family.updated_at;
        this.clan = family.clan;
        this.ring_choice_one = family.ring_choice_one;
        this.ring_choice_two = family.ring_choice_two;
        this.skill_one = family.skill_one;
        this.skill_two = family.skill_two;

        this.ring = ring;
    }

    public getRingBonuses = (): RingBonus[] => {
        return [
            {
                ring: this.ring,
                bonus: 1,
            }
        ];
    }

    public getSkillBonuses = (): SkillBonus[] => {
        if (!this.skill_one || !this.skill_two) {
            return [];
        }

        return [
            {
                skill: this.skill_one,
                bonus: 1,
            },
            {
                skill: this.skill_two,
                bonus: 1,
            }
        ];
    }

    public getGloryBonuses = (): number[] => [this.glory];

}
