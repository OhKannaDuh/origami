import axios from 'axios';
import { Character } from '@/ts/Character/View/Character';

export class SaveManager {
    public queue: {
        advantages?: number;
        disadvantages?: number;
        inventory?: number;
        advancements?: number;
        stats?: number;
    } = {};

    private save(path: string, payload: Object): Promise<any> {
        return axios.put(path, payload).finally(() => console.log('Saved'));
    }

    private addToQueue(path: string, payload: Object, callback: () => any) {
        return window.setTimeout(() => this.save(path, payload).then(callback), 5000);
    }

    public saveAdvantages(character: Character) {
        if (this.queue.advantages) {
            window.clearTimeout(this.queue.advantages);
        }

        this.queue.advantages = this.addToQueue('/api/character/save/advantages', { character }, () => delete this.queue.advantages);
    }

    public saveDisadvantages(character: Character) {
        if (this.queue.disadvantages) {
            window.clearTimeout(this.queue.disadvantages);
        }

        this.queue.disadvantages = this.addToQueue('/api/character/save/disadvantages', { character }, () => delete this.queue.disadvantages);
    }

    public saveInventory(character: Character, inventory: IInventory) {
        if (this.queue.inventory) {
            window.clearTimeout(this.queue.inventory);
        }

        this.queue.inventory = this.addToQueue('/api/character/save/inventory', { character, inventory }, () => delete this.queue.inventory);
    }

    public saveAdvancements(character: Character) {
        if (this.queue.advancements) {
            window.clearTimeout(this.queue.advancements);
        }

        this.queue.advancements = this.addToQueue('/api/character/save/advancements', { character }, () => delete this.queue.advancements);
    }

    public saveStats(character: Character) {
        if (this.queue.stats) {
            window.clearTimeout(this.queue.stats);
        }

        this.queue.stats = this.addToQueue(route('api.character.save.stats'), { character }, () => delete this.queue.stats);
    }
}
