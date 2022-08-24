import axios from 'axios';

interface Data {
    time: number;
    data: string;
}

interface Routes {
    all: string;
}

export abstract class Api {
    static routes(key: string): Routes {
        return {
            all: route(`api.${key}.all`),
        };
    }

    static put(key: string, value: object) {
        localStorage.setItem(
            key,
            JSON.stringify({
                time: Date.now(),
                data: JSON.stringify(value),
            })
        );
    }

    static getAll<Type>(key: string): Promise<Type[]> {
        let routes = Api.routes(key);

        return Api.execute<Type>(key, routes.all);
    }

    static execute<Type>(key: string, route: string): Promise<Type[]> {
        return new Promise<Type[]>((resolve) => {
            let storedData = localStorage.getItem(key);
            if (storedData !== null) {
                let data = JSON.parse(storedData) as Data;
                let now = Date.now();

                let diff = now - data.time;
                let seconds = Math.floor(diff / 1000);
                if (seconds <= 600) {
                    return resolve(JSON.parse(data.data) as Type[]);
                }
            }

            axios.get(route).then((response) => {
                this.put(key, response.data[key]);
                resolve(response.data[key]);
            });
        });
    }
}
