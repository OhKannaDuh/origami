import _ from 'lodash';
import { HeritageTableEntry } from './HeritageTableEntry';

export class HeritageTable {
    public name: string = '';
    public entries: HeritageTableEntry[] = [];

    public constructor(name: string) {
        this.name = name;
    }

    public addEntry = (entry: HeritageTableEntry) => this.entries.push(entry);
    public roll = (): HeritageTableEntry | undefined => _.sample<HeritageTableEntry>(this.entries);
}
