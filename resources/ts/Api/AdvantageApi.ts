import axios from 'axios';

export class AdvantageApi {
    static all(): Promise<App.Models.Character.Advantage[]> {
        return new Promise<App.Models.Character.Advantage[]>((resolve) => {
            axios.get('/api/advantages/all').then((response) => resolve(response.data.advantages));
        });
    }
}
