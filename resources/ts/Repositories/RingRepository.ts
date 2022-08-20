import { RingApi } from '../Api/RingApi';

export class RingRepository {
    private data: App.Models.Core.Ring[] = [];

    public init(): Promise<void> {
        return new Promise<void>((resolve) => {
            RingApi.all()
                .then((data: App.Models.Core.Ring[]) => (this.data = data))
                .catch((e) => console.error(e))
                .finally(resolve);
        });
    }

    public fromKey(key: string): App.Models.Core.Ring {
        for (const subject of this.data) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No ring with key ${key} found.`;
    }
}
