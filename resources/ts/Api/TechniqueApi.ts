import { Api } from './Api';

export class TechniqueApi extends Api {
    static all(): Promise<App.Models.Character.Technique[]> {
        return Api.getAll<App.Models.Character.Technique>('techniques');
    }
}
