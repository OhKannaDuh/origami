import { Api } from './Api';

export class RingApi extends Api {
    static all(): Promise<App.Models.Core.Ring[]> {
        return Api.getAll<App.Models.Core.Ring>('rings');
    }
}
