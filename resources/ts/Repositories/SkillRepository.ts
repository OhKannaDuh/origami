import { SkillApi } from '../Api/SkillApi';

export class SkillRepository {
    private data: App.Models.Core.Skill[] = [];

    public init(): Promise<void> {
        return new Promise<void>((resolve) => {
            SkillApi.all()
                .then((data: App.Models.Core.Skill[]) => (this.data = data))
                .catch((e) => console.error(e))
                .finally(resolve);
        });
    }

    public fromKey(key: string): App.Models.Core.Skill {
        for (const subject of this.data) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No skill with key ${key} found.`;
    }

    public all = (): App.Models.Core.Skill[] => this.data;

    public bySkillGroup(): { [key: string]: App.Models.Core.Skill[] } {
        let groups: { [key: string]: App.Models.Core.Skill[] } = {};
        for (const skill of this.data) {
            let groupKey: string = skill.skill_group?.name ?? '';
            if (!groupKey) {
                continue;
            }

            if (!groups.hasOwnProperty(groupKey)) {
                groups[groupKey] = [];
            }

            groups[groupKey].push(skill);
        }

        return groups;
    }
}
