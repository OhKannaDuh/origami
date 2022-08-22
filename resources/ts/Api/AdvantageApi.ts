import { Api } from './Api';

export class AdvantageApi extends Api {
    static all(): Promise<App.Models.Character.Advantage[]> {
        return Api.getAll<App.Models.Character.Advantage>('advantages');
    }
}
