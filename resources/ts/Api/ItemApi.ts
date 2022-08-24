import { Api } from './Api';

export class ItemApi extends Api {
    static all(): Promise<App.Models.Character.Item[]> {
        return Api.getAll<App.Models.Character.Item>('items');
    }
}
