import { BaseCalculatable } from './BaseCalculatable';

export class Ring extends BaseCalculatable implements App.Models.Core.Ring {
    public id: number;
    public key: string;
    public name: string;
    public created_at: string | null;
    public updated_at: string | null;

    public constructor(ring: App.Models.Core.Ring) {
        super();

        this.id = ring.id;
        this.key = ring.key;
        this.name = ring.name;
        this.created_at = ring.created_at;
        this.updated_at = ring.updated_at;
    }

    public getRingBonuses = (): RingBonus[] => [
        {
            ring: this,
            bonus: 1,
        },
    ];
}
