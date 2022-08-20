import { Client } from './Client';

export class CampaignChannel extends Client {
    private characterUpdateCallbacks: Function[] = [];

    public constructor(campaign: App.Models.Core.Campaign) {
        super();

        this.subscribe('private-campaign.' + campaign.uuid).bind('campaign.character.update', (event: CampaignUpdateCharacterPayload) => {
            for (const callback of this.characterUpdateCallbacks) {
                callback(event);
            }
        });
    }

    public addCharacterUpdateCallback = (callback: Function) => this.characterUpdateCallbacks.push(callback);
}
