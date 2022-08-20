import { AdvantageApi } from '../Api/AdvantageApi';

export class AdvantageRepository {
    private data: App.Models.Character.Advantage[] = [];

    public init(): Promise<void> {
        return new Promise<void>((resolve) => {
            AdvantageApi.all()
                .then((data: App.Models.Character.Advantage[]) => (this.data = data))
                .catch((e) => console.error(e))
                .finally(resolve);
        });
    }

    public fromKey(key: string): App.Models.Character.Advantage {
        for (const subject of this.data) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No advantage with key ${key} found.`;
    }

    public all = (): App.Models.Character.Advantage[] => this.data;

    public fromType(type: string) {
        let data: App.Models.Character.Advantage[] = [];
        for (const subject of this.data) {
            if (subject.advantage_type?.key === type) {
                data.push(subject);
            }
        }

        return data;
    }
}
