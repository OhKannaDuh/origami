declare type Step = {
    valid(): boolean;
    getTitle(): string;
};

declare interface CharacterCreationModelsData {
    adversities: App.Models.Character.Disadvantage[];
    anxieties: App.Models.Character.Disadvantage[];
    clans: App.Models.Character.Clan[];
    distinctions: App.Models.Character.Advantage[];
    families: App.Models.Character.Family[];
    item_subtypes: App.Models.Core.ItemSubtype[];
    item_types: App.Models.Core.ItemType[];
    items: App.Models.Character.Item[];
    passions: App.Models.Character.Advantage[];
    rings: App.Models.Core.Ring[];
    schools: App.Models.Character.School[];
    skills: App.Models.Core.Skill[];
    technique_types: App.Models.Core.TechniqueType[];
    techniques: App.Models.Character.Technique[];
}
declare interface RingValue {
    ring: App.Models.Core.Ring;
    rank: number;
}

declare interface Rings {
    [key: string]: RingValue;
}

declare interface SkillValue {
    skill: App.Models.Core.Skill;
    rank: number;
}

declare interface Skills {
    [key: string]: SkillValue;
}

declare interface RingBonus {
    ring: App.Models.Core.Ring;
    bonus: number;
}

declare interface SkillBonus {
    skill: App.Models.Core.Skill;
    bonus: number;
}

declare interface StartingTechniqueData {
    key: string;
    name: string;
    type: string;
    amount?: number | null;
    techniques: string[];
}
declare interface StartingOutfitData {
    type: string;
    item_key?: string | null;
    item_keys?: string[] | null;
    quantity?: number | null;
    choices?: number | null;
}
declare interface ChosenStartingOutfit {
    [key: string]: App.Models.Character.Item[];
    traveling_pack: App.Models.Character.Item[];
}
declare interface ClanRelationshipData {
    positive: boolean;
    skill?: App.Models.Core.Skill | null;
}

declare interface BushidoData {
    positive: boolean;
    skill?: App.Models.Core.Skill | null;
}

declare interface MentorRelationshipData {
    description: string;
    advantage?: App.Models.Character.Advantage | null;
    skill?: App.Models.Core.Skill | null;
    disadvantage?: App.Models.Character.Disadvantage | null;
}

declare interface OtherRelationshipsData {
    description: string;
    item?: App.Models.Character.Item | null;
}

declare interface ParentRelationshipData {
    description: string;
    skill?: App.Models.Core.Skill | null;
}

declare interface EffectRange {
    min: number;
    max: number;
}
declare interface IHeritageTableEffect {
    range: EffectRange;
    advantage?: App.Models.Character.Advantage | null;
    skill?: App.Models.Core.Skill | null;
    item?: App.Models.Character.Item | null;
    item_type: App.Models.Core.ItemType | null;
    item_subtype: App.Models.Core.ItemSubtype | null;
    fluff?: string | null;
}

declare interface IHeritageTableEntry {
    name: string;
    modifiers: {
        glory: number;
        honor: number;
        status: number;
    };
    effects: IHeritageTableEffect[];
}

declare interface IInventoryItem {
    item_key: string;
    quantity: number;
    custom_name: string;
    shouldRemove?: boolean;
    getName(): string;
    getItem(): App.Models.Character.Item;
    remove(): void;
}

declare interface IContainer {
    id: string;
    name: string;
    items: IInventoryItem[];
}

declare interface IInventory {
    containers: IContainer[];
}

declare interface CharacterStats {
    rings: { [key: string]: number };
    skills: { [key: string]: number };
    social: { [key: string]: number };
    conflict: { [key: string]: number };
}

declare enum AdvancementType {
    Ring = 'ring',
    Skill = 'skill',
    Technique = 'technique',
    RankUp = 'rank_up',
}

declare interface Advancement {
    type: AdvancementType;
    cost: number;
    key: string;
}
declare interface Advancements {
    xp: {
        total: number;
        spent: number;
    };

    advancements: Advancement[];
}

declare interface AdvancementRow {
    type: AdvancementType;
    name: string;
    key: string;
    cost: number;
}

declare interface SchoolCurriculumRank {
    type: string;
    technique_key: string;
    ignore_requirements: boolean;
    skill_group_key: string;
    skill_key: string;
    technique_type_key: string;
    technique_subtype_key: string;
    min_rank: number;
    max_rank: number;
}

declare interface SchoolCurriculum {
    [key: string]: SchoolCurriculumRank[];
}

declare interface Personality {
    lord: string;
    giri: string;
    ninjo: string;
    first_notice: string;
    stress: string;
    death: string;
    relationships: {
        mentor: string;
        other: string;
        parent: string;
    };
}

declare interface InertiaProps {
    props: {
        auth: {
            user: {
                id: number;
                name: string;
                email: string;
            };
        };
    };
}

declare interface WeaponData {
    skill_key: string;
    range: {
        min: number;
        max: number;
    };
    damage: number;
    deadliness: number;
    grips: { [key: number]: string };
}

declare interface ArmorData {
    physical: number;
    supernatural: number;
}

declare interface CombatantNpc {
    name: string;
    rings: { [key: string]: number };
    skills: { [key: string]: number };
    honor: number;
}

declare interface Combatant {
    name: string;
    uuid: string;
    initiative: number;
    rings: { [key: string]: number };
    skills: { [key: string]: number };
    stance: string;
    honor: number;
    isNpc: boolean;
    endurance: number;
    fatigue: number;
    composure: number;
    strife: number;
}

declare interface TechniqueOpportunity {
    cost: string;
    effect: string;
}

declare interface TechniqueDescription {
    activation: string;
    effect: string | null;
    enhancement: string | null;
    burst: string | null;
    opportunities: TechniqueOpportunity;
}
