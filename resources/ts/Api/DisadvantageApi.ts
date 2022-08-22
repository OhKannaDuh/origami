import axios from 'axios';
import { Api } from './Api';

export class DisadvantageApi extends Api {
    static all(): Promise<App.Models.Character.Disadvantage[]> {
        return Api.getAll<App.Models.Character.Disadvantage>('disadvantages');
    }
}
