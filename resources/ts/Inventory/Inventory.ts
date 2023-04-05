import { IInventory, IContainer, IInventoryItem } from '../data';
import { InventoryItem } from './InventoryItem';
import { ItemRepository } from '../Repositories/ItemRepository';

export class Inventory implements IInventory {
    public containers: IContainer[] = [];
    public repository: ItemRepository;

    public constructor(repository: ItemRepository) {
        this.repository = repository;
    }

    public static fromCharacterInventory(inventory: IInventory, repository: ItemRepository): Inventory {
        let model = new Inventory(repository);

        inventory.containers.forEach((container: IContainer) => {
            let proxyContainer: IContainer = {
                id: container.id,
                name: container.name,
                items: [],
            };

            container.items.forEach((item: IInventoryItem) => {
                let proxyItem: InventoryItem = new InventoryItem(item.item_key, repository);
                proxyItem.quantity = item.quantity;
                proxyItem.custom_name = item.custom_name;

                proxyContainer.items.push(proxyItem);
            });

            model.containers.push(proxyContainer);
        });

        return model;
    }

    public getTotalQuantity(key: string): number {
        let total = 0;
        this.containers.forEach((container: IContainer) => {
            container.items.forEach((item: IInventoryItem) => {
                if (item.item_key === key) {
                    total += parseInt(item.quantity);
                }
            });
        });

        return total;
    }
}
