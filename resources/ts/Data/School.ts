import { BaseCalculatable } from './BaseCalculatable';
import { CharacterCreationModels } from './CharacterCreationModels';

export class School extends BaseCalculatable implements App.Models.Character.School {
    public id: number;
    public source_book_id: number;
    public key: string;
    public name: string;
    public ring_one_id: number;
    public ring_two_id: number;
    public starting_skill_amount: number;
    public starting_skills: string;
    public starting_techniques: { [key: string]: StartingTechniqueData };
    public starting_outfit: StartingOutfitData[];
    public curriculum: SchoolCurriculum;
    public school_ability_id: number;
    public mastery_ability_id: number;
    public family_id: number | null;
    public created_at: string | null;
    public updated_at: string | null;
    public honor: number;
    public ring_one?: App.Models.Core.Ring | null | undefined;
    public ring_two?: App.Models.Core.Ring | null | undefined;
    public family?: App.Models.Character.Family | null;
    public available_technique_types?: App.Models.Core.TechniqueType[] | null | undefined;
    public school_types?: Array<App.Models.Core.SchoolType> | null;
    public available_technique_types_count?: number | null | undefined;
    public school_types_count?: number | null;

    public models: CharacterCreationModels;

    public skills: App.Models.Core.Skill[];
    public techniques: { [key: string]: App.Models.Character.Technique[] };
    public outfit: ChosenStartingOutfit;

    public constructor(
        school: App.Models.Character.School,
        models: CharacterCreationModels,
        skills: App.Models.Core.Skill[],
        techniques: { [key: string]: App.Models.Character.Technique[] },
        outfit: ChosenStartingOutfit
    ) {
        super();

        this.id = school.id;
        this.source_book_id = school.source_book_id;
        this.key = school.key;
        this.name = school.name;
        this.ring_one_id = school.ring_one_id;
        this.ring_two_id = school.ring_two_id;
        this.starting_skill_amount = school.starting_skill_amount;
        this.starting_skills = school.starting_skills;
        this.starting_techniques = school.starting_techniques;
        this.starting_outfit = school.starting_outfit;
        this.curriculum = school.curriculum;
        this.school_ability_id = school.school_ability_id;
        this.mastery_ability_id = school.mastery_ability_id;
        this.family_id = school.family_id;
        this.created_at = school.created_at;
        this.updated_at = school.updated_at;
        this.honor = school.honor;
        this.ring_one = school.ring_one;
        this.ring_two = school.ring_two;
        this.family = school.family;
        this.available_technique_types = school.available_technique_types;
        this.school_types = school.school_types;
        this.available_technique_types_count = school.available_technique_types_count;
        this.school_types_count = school.school_types_count;

        this.models = models;

        this.skills = skills;
        this.techniques = techniques;
        this.outfit = outfit;
    }

    public getRingBonuses = (): RingBonus[] => {
        if (!this.ring_one || !this.ring_two) {
            return [];
        }

        return [
            {
                ring: this.ring_one,
                bonus: 1,
            },
            {
                ring: this.ring_two,
                bonus: 1,
            },
        ];
    };

    public getSkillBonuses = (): SkillBonus[] => {
        let bonuses: SkillBonus[] = [];
        this.skills.forEach((skill: App.Models.Core.Skill) =>
            bonuses.push({
                skill: skill,
                bonus: 1,
            })
        );

        return bonuses;
    };

    public getHonorBonuses = (): number[] => [this.honor];

    public getTechniques = (): App.Models.Character.Technique[] => {
        let techniques: App.Models.Character.Technique[] = [];
        for (const [key, data] of Object.entries(this.starting_techniques)) {
            if (data.type === 'group') {
                data.techniques.forEach((key: string) => techniques.push(this.models.getTechnique(key)));
                continue;
            }

            if (data.type === 'choice' && this.techniques[key]) {
                this.techniques[key].forEach((technique: App.Models.Character.Technique) => techniques.push(technique));
                continue;
            }
        }
        return techniques;
    };

    public getItems = (): App.Models.Character.Item[] => {
        let items: App.Models.Character.Item[] = [];
        for (const [key, data] of Object.entries(this.starting_outfit)) {
            if (data.type === 'item' && data.item_key) {
                items.push(this.models.getItem(data.item_key));
            }

            if (data.type === 'choice') {
                this.outfit[key].forEach((item: App.Models.Character.Item) => items.push(item));
            }

            if (data.type === 'daisho') {
                items.push(this.models.getItem('katana'));
                items.push(this.models.getItem('wakizashi'));
            }

            if (data.type === 'traveling_pack') {
                items.push(this.models.getItem('blanket'));
                items.push(this.models.getItem('chopsticks'));
                items.push(this.models.getItem('traveling_rations'));
                items.push(this.models.getItem('flint_and_tinder'));

                this.outfit.traveling_pack.forEach((item: App.Models.Character.Item) => items.push(item));
            }
        }
        return items;
    };
}
