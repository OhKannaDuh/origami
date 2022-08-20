import { CharacterCreationModels } from './CharacterCreationModels';

export class StartingOutfit implements StartingOutfitData {
    public type: string;
    public item_key?: string | null;
    public item_keys?: string[] | null;
    public quantity?: number | null;
    public choices?: number | null;

    public models: CharacterCreationModels;

    public constructor(data: StartingOutfitData, models: CharacterCreationModels) {
        this.type = data.type;
        this.item_key = data.item_key;
        this.item_keys = data.item_keys;
        this.quantity = data.quantity;
        this.choices = data.choices;

        this.models = models;
    }

    public toText(): string {
        if (this.type === 'item' && this.item_key) {
            return this.models.getItem(this.item_key).name;
        }

        if (this.type === 'choice' && this.item_keys && this.choices) {
            let items: string[] = [];
            for (const key of this.item_keys) {
                items.push(this.models.getItem(key).name);
            }

            return items.join(' or ');
        }

        if (this.type === 'daisho') {
            let katana: App.Models.Character.Item = this.models.getItem('katana');
            let wakizashi: App.Models.Character.Item = this.models.getItem('wakizashi');

            return `Daisho (${katana.name} and ${wakizashi.name})`;
        }

        if (this.type === 'traveling_pack') {
            let items: string[] = [];
            items.push(this.models.getItem('blanket').name);
            items.push(this.models.getItem('chopsticks').name);
            items.push(this.models.getItem('traveling_rations').name);
            items.push(this.models.getItem('flint_and_tinder').name);

            return `Travelling Pack (${items.join(', ')}, and any three other items that are rarity 4 or lower)`;
        }

        return 'unknown';
    }

    public getItems(): App.Models.Character.Item[] {
        let items: App.Models.Character.Item[] = [];

        if (this.type === 'item' && this.item_key) {
            items.push(this.models.getItem(this.item_key));
        }

        if (this.type === 'choice' && this.item_keys && this.choices) {
            for (const key of this.item_keys) {
                items.push(this.models.getItem(key));
            }
        }

        if (this.type === 'daisho') {
            items.push(this.models.getItem('katana'));
            items.push(this.models.getItem('wakizashi'));
        }

        if (this.type === 'traveling_pack') {
            items.push(this.models.getItem('blanket'));
            items.push(this.models.getItem('chopsticks'));
            items.push(this.models.getItem('traveling_rations'));
            items.push(this.models.getItem('flint_and_tinder'));
        }

        return items;
    }
}
