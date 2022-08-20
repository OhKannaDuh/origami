import axios from 'axios';

export class DisadvantageApi {
    static all(): Promise<App.Models.Character.Disadvantage[]> {
        return new Promise<App.Models.Character.Disadvantage[]>((resolve) => {
            axios.get('/api/disadvantages/all').then((response) => resolve(response.data.disadvantages));
        });
    }
}
