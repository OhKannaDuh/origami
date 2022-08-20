import axios from 'axios';
import { CharacterBase } from './CharacterBase';

export class Character extends CharacterBase {
    public constructor(data: App.Models.Character.Character) {
        super(data);
    }

    public getAdvantagesOfType(key: string): App.Models.Character.Advantage[] {
        let data: App.Models.Character.Advantage[] = [];
        for (const subject of this.advantages ?? []) {
            if (subject.advantage_type?.key === key) {
                data.push(subject);
            }
        }

        return data;
    }

    public getDisadvantagesOfType(key: string): App.Models.Character.Disadvantage[] {
        let data: App.Models.Character.Disadvantage[] = [];
        for (const subject of this.disadvantages ?? []) {
            if (subject.disadvantage_type?.key === key) {
                data.push(subject);
            }
        }

        return data;
    }

    public getAdvantageIndex(item: App.Models.Character.Advantage): number {
        let index: number = 0;
        for (const subject of this.advantages ?? []) {
            if (subject.key === item.key && subject.advantage_type?.key === item.advantage_type?.key) {
                return index;
            }

            index++;
        }

        return -1;
    }

    public getDisadvantageIndex(item: App.Models.Character.Disadvantage): number {
        let index: number = 0;
        for (const subject of this.disadvantages ?? []) {
            if (subject.key === item.key && subject.disadvantage_type?.key === item.disadvantage_type?.key) {
                return index;
            }

            index++;
        }

        return -1;
    }

    public removeAdvantage(item: App.Models.Character.Advantage) {
        if (this.getAdvantageIndex(item) < 0) {
            return;
        }

        let index = this.advantages?.indexOf(item);
        if (index) {
            this.advantages?.splice(index, 1);
        }
    }
}
