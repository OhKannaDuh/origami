import { BaseCalculatable } from './BaseCalculatable';

export class OtherRelationship extends BaseCalculatable implements OtherRelationshipsData {
    public description: string;
    public item?: App.Models.Character.Item | null;

    public constructor(data: OtherRelationshipsData) {
        super();

        this.description = data.description;
        this.item = data.item;
    }

    public getItems = (): App.Models.Character.Item[] => {
        if (!this.item) {
            return [];
        }

        return [this.item];
    };
}
