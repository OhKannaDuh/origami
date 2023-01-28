/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface User {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        password: string;
        admin: boolean;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
        characters?: Array<App.Models.Character.Character> | null;
        owned_campaigns?: Array<App.Models.Core.Campaign> | null;
        campaigns?: Array<App.Models.Core.Campaign> | null;
        characters_count?: number | null;
        owned_campaigns_count?: number | null;
        campaigns_count?: number | null;
    }

}

declare namespace App.Models.Core {
    export interface TechniqueType {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface SchoolType {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface SourceBook {
        id: number;
        key: string;
        name: string;
        image: string;
        created_at: string | null;
        updated_at: string | null;
        is_official: boolean;
        clans?: Array<App.Models.Character.Clan> | null;
        families?: Array<App.Models.Character.Family> | null;
        techniques?: Array<App.Models.Character.Technique> | null;
        items?: Array<App.Models.Character.Item> | null;
        schools?: Array<App.Models.Character.School> | null;
        advantages?: Array<App.Models.Character.Advantage> | null;
        disadvantages?: Array<App.Models.Character.Disadvantage> | null;
        clans_count?: number | null;
        families_count?: number | null;
        techniques_count?: number | null;
        items_count?: number | null;
        schools_count?: number | null;
        advantages_count?: number | null;
        disadvantages_count?: number | null;
    }

    export interface DisadvantageCategory {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface AdvantageCategory {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Ring {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface TechniqueSubtype {
        id: number;
        technique_type_id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
        technique_type?: App.Models.Core.TechniqueType | null;
    }

    export interface AdvantageType {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface ItemSubtype {
        id: number;
        item_type_id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
        item_type?: App.Models.Core.ItemType | null;
    }

    export interface SkillGroup {
        id: number;
        key: string;
        name: string;
        description: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Skill {
        id: number;
        skill_group_id: number;
        key: string;
        name: string;
        description: string;
        created_at: string | null;
        updated_at: string | null;
        skill_group?: App.Models.Core.SkillGroup | null;
    }

    export interface DisadvantageType {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface Campaign {
        id: number;
        uuid: string;
        name: string;
        description: string;
        user_id: number;
        npcs: string;
        created_at: string | null;
        updated_at: string | null;
        characters?: Array<App.Models.Character.Character> | null;
        users?: Array<App.Models.User> | null;
        characters_count?: number | null;
        users_count?: number | null;
    }

    export interface ItemType {
        id: number;
        key: string;
        name: string;
        created_at: string | null;
        updated_at: string | null;
    }

}

declare namespace App.Models.Character {
    export interface Clan {
        id: number;
        source_book_id: number;
        ring_id: number;
        skill_id: number;
        key: string;
        name: string;
        status: number;
        is_major: boolean;
        description: string;
        created_at: string | null;
        updated_at: string | null;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        ring?: App.Models.Core.Ring | null;
        skill?: App.Models.Core.Skill | null;
    }

    export interface Advantage {
        id: number;
        source_book_id: number;
        advantage_type_id: number;
        ring_id: number;
        key: string;
        name: string;
        effects: string;
        created_at: string | null;
        updated_at: string | null;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        advantage_type?: App.Models.Core.AdvantageType | null;
        ring?: App.Models.Core.Ring | null;
        advantage_categories?: Array<App.Models.Core.AdvantageCategory> | null;
        advantage_categories_count?: number | null;
    }

    export interface Family {
        id: number;
        source_book_id: number;
        clan_id: number;
        ring_choice_one_id: number;
        ring_choice_two_id: number;
        skill_one_id: number;
        skill_two_id: number;
        key: string;
        name: string;
        glory: number;
        starting_wealth: number;
        description: string;
        created_at: string | null;
        updated_at: string | null;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        clan?: App.Models.Character.Clan | null;
        ring_choice_one?: App.Models.Core.Ring | null;
        ring_choice_two?: App.Models.Core.Ring | null;
        skill_one?: App.Models.Core.Skill | null;
        skill_two?: App.Models.Core.Skill | null;
    }

    export interface Technique {
        id: number;
        source_book_id: number;
        technique_subtype_id: number;
        key: string;
        name: string;
        rank: number;
        description: TechniqueDescription;
        created_at: string | null;
        updated_at: string | null;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        technique_subtype?: App.Models.Core.TechniqueSubtype | null;
    }

    export interface Item {
        id: number;
        source_book_id: number;
        item_subtype_id: number;
        key: string;
        name: string;
        description: string;
        data: WeaponData | ArmorData;
        cost: string;
        rarity: number;
        created_at: string | null;
        updated_at: string | null;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        item_subtype?: App.Models.Core.ItemSubtype | null;
    }

    export interface Character {
        id: number;
        uuid: string;
        user_id: number;
        name: string;
        inventory: IInventory;
        clan_id: number;
        family_id: number;
        school_id: number;
        school_rank: number;
        avatar: string;
        advancements: Advancements;
        personality: string;
        heritage: string;
        stats: CharacterStats;
        created_at: string | null;
        updated_at: string | null;
        user?: App.Models.User | null;
        clan?: App.Models.Character.Clan | null;
        family?: App.Models.Character.Family | null;
        school?: App.Models.Character.School | null;
        advantages?: Array<App.Models.Character.Advantage> | null;
        disadvantages?: Array<App.Models.Character.Disadvantage> | null;
        techniques?: Array<App.Models.Character.Technique> | null;
        campaigns?: Array<App.Models.Core.Campaign> | null;
        advantages_count?: number | null;
        disadvantages_count?: number | null;
        techniques_count?: number | null;
        campaigns_count?: number | null;
    }

    export interface School {
        id: number;
        source_book_id: number;
        key: string;
        name: string;
        ring_mode: string;
        ring_one_id: number | null;
        ring_two_id: number | null;
        starting_skill_amount: number;
        starting_skills: string;
        starting_techniques: {[key: string]: StartingTechniqueData};
        starting_outfit: StartingOutfitData[];
        curriculum: SchoolCurriculum;
        school_ability_id: number | null;
        mastery_ability_id: number | null;
        family_id: number | null;
        created_at: string | null;
        updated_at: string | null;
        honor: number;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        ring_one?: App.Models.Core.Ring | null;
        ring_two?: App.Models.Core.Ring | null;
        family?: App.Models.Character.Family | null;
        available_technique_types?: Array<App.Models.Core.TechniqueType> | null;
        available_technique_subtypes?: Array<App.Models.Core.TechniqueSubtype> | null;
        school_types?: Array<App.Models.Core.SchoolType> | null;
        available_technique_types_count?: number | null;
        available_technique_subtypes_count?: number | null;
        school_types_count?: number | null;
    }

    export interface Disadvantage {
        id: number;
        source_book_id: number;
        disadvantage_type_id: number;
        ring_id: number;
        key: string;
        name: string;
        effects: string;
        created_at: string | null;
        updated_at: string | null;
        page_number: number | null;
        source_book?: App.Models.Core.SourceBook | null;
        disadvantage_type?: App.Models.Core.DisadvantageType | null;
        ring?: App.Models.Core.Ring | null;
        disadvantage_categories?: Array<App.Models.Core.DisadvantageCategory> | null;
        disadvantage_categories_count?: number | null;
    }

}
