import axios from 'axios';

export class TechniqueApi {
    static all(): Promise<App.Models.Character.Technique[]> {
        return new Promise<App.Models.Character.Technique[]>((resolve) => {
            axios.get('/api/techniques/all').then((response) => resolve(response.data.techniques));
        });
    }
}
