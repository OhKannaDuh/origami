import { Api } from './Api';

export class SkillApi extends Api {
    static all(): Promise<App.Models.Core.Skill[]> {
        return Api.getAll<App.Models.Core.Skill>('skills');
    }
}
