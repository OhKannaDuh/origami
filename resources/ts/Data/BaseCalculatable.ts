import { ICalculatable } from './ICalculatable';

export abstract class BaseCalculatable implements ICalculatable {
    public getRingBonuses = (): RingBonus[] => [];
    public getSkillBonuses = (): SkillBonus[] => [];
    // Social Status
    public getStatusBonuses = (): number[] => [];
    public getGloryBonuses = (): number[] => [];
    public getHonorBonuses = (): number[] => [];
    // Techniques
    public getTechniques = (): App.Models.Character.Technique[] => [];
    // Items
    public getItems = (): App.Models.Character.Item[] => [];
    // Advantages and Disadvantages
    public getDistinctions = (): App.Models.Character.Advantage[] => [];
    public getPassions = (): App.Models.Character.Advantage[] => [];
    public getAdversities = (): App.Models.Character.Disadvantage[] => [];
    public getAnxieties = (): App.Models.Character.Disadvantage[] => [];
}
