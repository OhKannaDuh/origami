import axios from 'axios';

export class ItemApi {
    static all(): Promise<App.Models.Character.Item[]> {
        return new Promise<App.Models.Character.Item[]>((resolve) => {
            axios.get('/api/items/all').then((response) => resolve(response.data.items));
        });
    }
}
