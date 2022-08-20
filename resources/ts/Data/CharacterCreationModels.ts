export class CharacterCreationModels implements CharacterCreationModelsData {
    public adversities: App.Models.Character.Disadvantage[];
    public anxieties: App.Models.Character.Disadvantage[];
    public clans: App.Models.Character.Clan[];
    public distinctions: App.Models.Character.Advantage[];
    public families: App.Models.Character.Family[];
    public item_subtypes: App.Models.Core.ItemSubtype[];
    public item_types: App.Models.Core.ItemType[];
    public items: App.Models.Character.Item[];
    public passions: App.Models.Character.Advantage[];
    public rings: App.Models.Core.Ring[];
    public schools: App.Models.Character.School[];
    public skills: App.Models.Core.Skill[];
    public technique_types: App.Models.Core.TechniqueType[];
    public techniques: App.Models.Character.Technique[];

    public constructor(data: CharacterCreationModelsData) {
        this.adversities = data.adversities;
        this.anxieties = data.anxieties;
        this.clans = data.clans;
        this.distinctions = data.distinctions;
        this.families = data.families;
        this.item_subtypes = data.item_subtypes;
        this.item_types = data.item_types;
        this.items = data.items;
        this.passions = data.passions;
        this.rings = data.rings;
        this.schools = data.schools;
        this.skills = data.skills;
        this.technique_types = data.technique_types;
        this.techniques = data.techniques;
    }

    public getRing(key: string): App.Models.Core.Ring {
        for (const ring of this.rings) {
            if (ring.key === key) {
                return ring;
            }
        }

        throw `No ring with key ${key} could be found.`;
    }

    public getClan(key: string): App.Models.Character.Clan {
        for (const clan of this.clans) {
            if (clan.key === key) {
                return clan;
            }
        }

        throw `No clan with key ${key} could be found.`;
    }

    public getFemily(key: string): App.Models.Character.Family {
        for (const family of this.families) {
            if (family.key === key) {
                return family;
            }
        }

        throw `No family with key ${key} could be found.`;
    }

    public getSchool(key: string): App.Models.Character.School {
        for (const school of this.schools) {
            if (school.key === key) {
                return school;
            }
        }

        throw `No school with key ${key} could be found.`;
    }

    public getSkill(key: string): App.Models.Core.Skill {
        for (const skill of this.skills) {
            if (skill.key === key) {
                return skill;
            }
        }

        throw `No skill with key ${key} could be found.`;
    }

    public getTechnique(key: string): App.Models.Character.Technique {
        for (const technique of this.techniques) {
            if (technique.key === key) {
                return technique;
            }
        }

        throw `No technique with key ${key} could be found.`;
    }

    public getTechniquesOfType(key: string): App.Models.Character.Technique[] {
        let techniques: App.Models.Character.Technique[] = [];
        for (const technique of this.techniques) {
            if (technique.technique_subtype?.technique_type?.key === key) {
                techniques.push(technique);
            }
        }

        return techniques;
    }

    public getTechniqueType(key: string): App.Models.Core.TechniqueType {
        for (const subject of this.technique_types) {
            if (subject.key === key) {
                return subject;
            }
        }

        throw `No technique type with key ${key} could be found.`;
    }

    public getItem(key: string): App.Models.Character.Item {
        for (const item of this.items) {
            if (item.key === key) {
                return item;
            }
        }

        throw `No item with key ${key} could be found.`;
    }

    public getItemsOfRarityOrBelow(rarity: number): App.Models.Character.Item[] {
        let items: App.Models.Character.Item[] = [];
        this.items.forEach((item: App.Models.Character.Item) => {
            if (item.rarity <= rarity) {
                items.push(item);
            }
        });
        return items;
    }

    public getDistinction(key: string): App.Models.Character.Advantage {
        for (const distinction of this.distinctions) {
            if (distinction.key === key) {
                return distinction;
            }
        }

        throw `No distinction with key ${key} could be found.`;
    }

    public getAdversity(key: string): App.Models.Character.Disadvantage {
        for (const adversity of this.adversities) {
            if (adversity.key === key) {
                return adversity;
            }
        }

        throw `No adversity with key ${key} could be found.`;
    }

    public getPassion(key: string): App.Models.Character.Advantage {
        for (const passion of this.passions) {
            if (passion.key === key) {
                return passion;
            }
        }

        throw `No passion with key ${key} could be found.`;
    }

    public getAnxiety(key: string): App.Models.Character.Disadvantage {
        for (const anxiety of this.anxieties) {
            if (anxiety.key === key) {
                return anxiety;
            }
        }

        throw `No anxiety with key ${key} could be found.`;
    }

    public getAdvantages(): App.Models.Character.Advantage[] {
        let advantages: App.Models.Character.Advantage[] = [];
        this.distinctions.forEach((distinction: App.Models.Character.Advantage) => advantages.push(distinction));
        this.passions.forEach((passion: App.Models.Character.Advantage) => advantages.push(passion));

        return advantages;
    }

    public getDisadvantages(): App.Models.Character.Disadvantage[] {
        let disadvantages: App.Models.Character.Disadvantage[] = [];
        this.adversities.forEach((adversity: App.Models.Character.Disadvantage) => disadvantages.push(adversity));
        this.anxieties.forEach((anxiety: App.Models.Character.Disadvantage) => disadvantages.push(anxiety));

        return disadvantages;
    }

    public getItemType(key: string): App.Models.Core.ItemType {
        for (const type of this.item_types) {
            if (type.key === key) {
                return type;
            }
        }

        throw `No item type with key ${key} could be found.`;
    }

    public getItemSubtype(key: string): App.Models.Core.ItemSubtype {
        for (const type of this.item_subtypes) {
            if (type.key === key) {
                return type;
            }
        }

        throw `No item subtype with key ${key} could be found.`;
    }

    public getItemsOfType(type: App.Models.Core.ItemType): App.Models.Character.Item[] {
        let items: App.Models.Character.Item[] = [];
        this.items.forEach((item: App.Models.Character.Item) => {
            if (item.item_subtype?.item_type?.key === type.key) {
                items.push(item);
            }
        });

        return items;
    }

    public getItemsOfSubtype(type: App.Models.Core.ItemSubtype): App.Models.Character.Item[] {
        let items: App.Models.Character.Item[] = [];
        this.items.forEach((item: App.Models.Character.Item) => {
            if (item.item_subtype?.key === type.key) {
                items.push(item);
            }
        });

        return items;
    }
}
