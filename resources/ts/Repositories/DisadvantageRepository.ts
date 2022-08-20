import { DisadvantageApi } from '../Api/DisadvantageApi';

export class DisadvantageRepository {
    private data: App.Models.Character.Disadvantage[] = [];

    public init(): Promise<void> {
        return new Promise<void>((resolve) => {
            DisadvantageApi.all()
                .then((data: App.Models.Character.Disadvantage[]) => (this.data = data))
                .catch((e) => console.error(e))
                .finally(resolve);
        });
    }

    public fromKey(key: string): App.Models.Character.Disadvantage {
        for (const subject of this.data) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No disadvantage with key ${key} found.`;
    }

    public all = (): App.Models.Character.Disadvantage[] => this.data;

    public fromType(type: string) {
        let data: App.Models.Character.Disadvantage[] = [];
        for (const subject of this.data) {
            if (subject.disadvantage_type?.key === type) {
                data.push(subject);
            }
        }

        return data;
    }
}
