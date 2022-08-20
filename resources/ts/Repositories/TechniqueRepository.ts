import { conforms } from 'lodash';
import { TechniqueApi } from '../Api/TechniqueApi';

export class TechniqueRepository {
    private data: App.Models.Character.Technique[] = [];

    public init(): Promise<void> {
        return new Promise<void>((resolve) => {
            TechniqueApi.all()
                .then((data: App.Models.Character.Technique[]) => (this.data = data))
                .catch((e) => console.error(e))
                .finally(resolve);
        });
    }

    public fromKey(key: string): App.Models.Character.Technique {
        for (const subject of this.data) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No item with key ${key} found.`;
    }

    public all = (): App.Models.Character.Technique[] => this.data;

    public getByTypeAndRank(type: App.Models.Core.TechniqueType, rank: number): App.Models.Character.Technique[] {
        let data: App.Models.Character.Technique[] = [];
        for (const subject of this.data) {
            let subjectTypeKey = subject.technique_subtype?.technique_type?.key ?? '';
            if (subjectTypeKey === type.key && subject.rank <= rank) {
                data.push(subject);
            }
        }

        return data;
    }
}
