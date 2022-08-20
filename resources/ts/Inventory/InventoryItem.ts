import { ItemRepository } from '../Repositories/ItemRepository';

export class InventoryItem implements IInventoryItem {
    public item_key: string;
    public quantity: number = 1;
    public custom_name: string = '';
    public shouldRemove: boolean = false;

    private repository: ItemRepository;

    public constructor(item: App.Models.Character.Item | string, repository: ItemRepository) {
        if (typeof item !== 'string') {
            item = item.key;
        }

        this.item_key = item;
        this.repository = repository;
    }

    public getItem(): App.Models.Character.Item {
        return this.repository.fromKey(this.item_key);
    }

    public getName(): string {
        return this.custom_name ? this.custom_name : this.getItem().name;
    }

    public remove(): void {
        this.shouldRemove = true;
    }
}
