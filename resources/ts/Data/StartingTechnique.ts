import { CharacterCreationModels } from "./CharacterCreationModels";

export class StartingTechnique implements StartingTechniqueData {
    public key: string;
    public name: string;
    public type: string;
    public amount?: number | null;
    public techniques: string[];
    public models: CharacterCreationModels;


    public constructor(data: StartingTechniqueData, models: CharacterCreationModels) {
        this.key = data.key;
        this.name = data.name;
        this.type = data.type;
        this.amount = data.amount;
        this.techniques = data.techniques;
        this.models = models;
    }

    public isChoice = (): boolean => this.type === 'choice';

    public getTechniques(): App.Models.Character.Technique[] {
        let techniques: App.Models.Character.Technique[] = [];
        for (const key of this.techniques) {
            techniques.push(this.models.getTechnique(key));
        }

        return techniques;
    }
}
