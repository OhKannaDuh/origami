import axios from 'axios';

export class SkillApi {
    static all(): Promise<App.Models.Core.Skill[]> {
        return new Promise<App.Models.Core.Skill[]>((resolve) => {
            axios.get('/api/skills/all').then((response) => resolve(response.data.skills));
        });
    }
}
