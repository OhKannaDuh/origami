export class CharacterBase implements App.Models.Character.Character {
    public id: number;
    public uuid: string;
    public user_id: number;
    public name: string;
    public inventory: IInventory;
    public clan_id: number;
    public family_id: number;
    public school_id: number;
    public school_rank: number;
    public avatar: string;
    public advancements: Advancements;
    public personality: string;
    public heritage: string;
    public stats: CharacterStats;
    public allow_nonhuman_techniques: boolean;
    public created_at: string | null;
    public updated_at: string | null;
    public clan?: App.Models.Character.Clan | null;
    public family?: App.Models.Character.Family | null;
    public school?: App.Models.Character.School | null;
    public advantages?: Array<App.Models.Character.Advantage> | null;
    public disadvantages?: Array<App.Models.Character.Disadvantage> | null;
    public techniques?: Array<App.Models.Character.Technique> | null;
    public campaigns?: Array<App.Models.Core.Campaign> | null;
    public advantages_count?: number | null;
    public disadvantages_count?: number | null;
    public techniques_count?: number | null;
    public campaigns_count?: number | null;

    public constructor(data: App.Models.Character.Character) {
        this.id = data.id;
        this.uuid = data.uuid;
        this.user_id = data.user_id;
        this.name = data.name;
        this.inventory = data.inventory;
        this.clan_id = data.clan_id;
        this.family_id = data.family_id;
        this.school_id = data.school_id;
        this.school_rank = data.school_rank;
        this.avatar = data.avatar;
        this.advancements = data.advancements;
        this.personality = data.personality;
        this.heritage = data.heritage;
        this.stats = data.stats;
        this.allow_nonhuman_techniques = data.allow_nonhuman_techniques;
        this.created_at = data.created_at;
        this.updated_at = data.updated_at;
        this.clan = data.clan;
        this.family = data.family;
        this.school = data.school;
        this.advantages = data.advantages;
        this.disadvantages = data.disadvantages;
        this.techniques = data.techniques;
        this.campaigns = data.campaigns;
        this.advantages_count = data.advantages_count;
        this.disadvantages_count = data.disadvantages_count;
        this.techniques_count = data.techniques_count;
        this.campaigns_count = data.campaigns_count;
    }
}
