import _ from 'lodash';
import { CharacterCreationModels } from './CharacterCreationModels';

export class HeritageTableEffect implements IHeritageTableEffect {
    public name: string = '';
    public range: EffectRange;
    public advantage?: App.Models.Character.Advantage | null;
    public skill?: App.Models.Core.Skill | null;
    public item?: App.Models.Character.Item | null;
    public item_type: App.Models.Core.ItemType | null = null;
    public item_subtype: App.Models.Core.ItemSubtype | null = null;
    public technique_type: App.Models.Core.TechniqueType | null = null;
    public fluff?: string | null;

    public constructor(min: number, max: number = 0) {
        if (max === 0) {
            max = min;
        }

        this.range = { min, max };
    }

    public withAdvantage(advantage: App.Models.Character.Advantage): HeritageTableEffect {
        this.advantage = advantage;
        this.name = advantage.name;
        return this;
    }

    public withSkill(skill: App.Models.Core.Skill): HeritageTableEffect {
        this.skill = skill;
        this.name = skill.name;
        return this;
    }

    public withItem(item: App.Models.Character.Item): HeritageTableEffect {
        this.item = item;
        this.name = item.name;
        return this;
    }

    public withItemType(type: App.Models.Core.ItemType): HeritageTableEffect {
        this.item_type = type;
        this.name = type.name;
        return this;
    }

    public withItemSubtype(subtype: App.Models.Core.ItemSubtype): HeritageTableEffect {
        this.item_subtype = subtype;
        this.name = subtype.name;
        return this;
    }

    public withTechniqueType(type: App.Models.Core.TechniqueType): HeritageTableEffect {
        this.technique_type = type;
        this.name = type.name;
        return this;
    }

    public withFluff(fluff: string): HeritageTableEffect {
        this.fluff = fluff;
        this.name = fluff;
        return this;
    }

    public hasMultipleChoices(): boolean {
        return this.choiceIsItem() || this.choiceIsTechnique();
    }

    public choiceIsItem(): boolean {
        return this.item_type !== null || this.item_subtype !== null;
    }

    public choiceIsTechnique(): boolean {
        return this.technique_type !== null;
    }

    public getChoices(models: CharacterCreationModels): App.Models.Character.Item[] | App.Models.Character.Technique[] {
        if (this.item_type) {
            return models.getItemsOfType(this.item_type);
        }

        if (this.item_subtype) {
            return models.getItemsOfSubtype(this.item_subtype);
        }

        if (this.technique_type) {
            return models.getTechniquesOfType(this.technique_type.key);
        }

        return [];
    }
}
