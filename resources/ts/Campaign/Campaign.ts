import { CampaignChannel } from '../Socket/CampaignChannel';

export class Campaign {
    private channel: CampaignChannel;

    public id: number;
    public uuid: string;
    public name: string;
    public user_id: number;
    public created_at: string | null;
    public updated_at: string | null;
    public characters: Array<App.Models.Character.Character>;
    public users?: Array<App.Models.User> | null;
    public characters_count?: number | null;
    public users_count?: number | null;

    public constructor(data: App.Models.Core.Campaign) {
        this.id = data.id;
        this.uuid = data.uuid;
        this.name = data.name;
        this.user_id = data.user_id;
        this.created_at = data.created_at;
        this.updated_at = data.updated_at;
        this.characters = data.characters ?? [];
        this.users = data.users;
        this.characters_count = data.characters_count;
        this.users_count = data.users_count;

        this.channel = new CampaignChannel(data);
        this.channel.addCharacterUpdateCallback((event: CampaignUpdateCharacterPayload) => {
            for (const character of this.characters) {
                if (event.character.uuid === character.uuid) {
                    Object.assign(character, event.character);
                }
            }
        });
    }

    public addCharacterUpdateCallback = (callback: Function) => this.channel.addCharacterUpdateCallback(callback);
}
