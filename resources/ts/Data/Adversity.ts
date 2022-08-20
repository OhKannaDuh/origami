import { BaseCalculatable } from './BaseCalculatable';

export class Adversity extends BaseCalculatable implements App.Models.Character.Disadvantage {
    public id: number;
    public source_book_id: number;
    public disadvantage_type_id: number;
    public ring_id: number;
    public key: string;
    public name: string;
    public created_at: string | null;
    public updated_at: string | null;
    public ring?: App.Models.Core.Ring | null;

    public constructor(data: App.Models.Character.Disadvantage) {
        super();

        this.id = data.id;
        this.source_book_id = data.source_book_id;
        this.disadvantage_type_id = data.disadvantage_type_id;
        this.ring_id = data.ring_id;
        this.key = data.key;
        this.name = data.name;
        this.created_at = data.created_at;
        this.updated_at = data.updated_at;
        this.ring = data.ring;
    }

    public getAdversities = (): App.Models.Character.Disadvantage[] => [this];
}
