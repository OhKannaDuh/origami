import axios from 'axios';

export class RingApi {
    static all(): Promise<App.Models.Core.Ring[]> {
        return new Promise<App.Models.Core.Ring[]>((resolve) => {
            let data: App.Models.Core.Ring[] = [];

            let storedData = localStorage.getItem('rings');
            if (storedData !== null) {
                data = JSON.parse(storedData);
            }

            axios.get('/api/rings/all').then((response) => {
                data = response.data.rings;
                localStorage.setItem('rings', JSON.stringify(data));

                resolve(data);
            });
        });
    }
}
