import { ItemApi } from '../Api/ItemApi';

export class ItemRepository {
    private data: App.Models.Character.Item[] = [];

    public init(): Promise<void> {
        return new Promise<void>((resolve) => {
            ItemApi.all()
                .then((data: App.Models.Character.Item[]) => (this.data = data))
                .catch((e) => console.error(e))
                .finally(resolve);
        });
    }

    public fromKey(key: string): App.Models.Character.Item {
        for (const subject of this.data) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No item with key ${key} found.`;
    }

    public all = (): App.Models.Character.Item[] => this.data;
}
