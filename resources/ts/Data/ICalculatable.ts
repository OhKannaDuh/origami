export interface ICalculatable {
    getRingBonuses(): RingBonus[];
    getSkillBonuses(): SkillBonus[];
    // Social Stats
    getStatusBonuses(): number[];
    getGloryBonuses(): number[];
    getHonorBonuses(): number[];
    // Techniques
    getTechniques(): App.Models.Character.Technique[];
    // Items
    getItems(): App.Models.Character.Item[];
    // Advantages and Disadvantages
    getDistinctions(): App.Models.Character.Advantage[];
    getPassions(): App.Models.Character.Advantage[];
    getAdversities(): App.Models.Character.Disadvantage[];
    getAnxieties(): App.Models.Character.Disadvantage[];
}
