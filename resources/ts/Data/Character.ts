import { Adversity } from './Adversity';
import { Anxiety } from './Anxiety';
import { Bushido } from './Bushido';
import { CharacterCreationModels } from './CharacterCreationModels';
import { Clan } from './Clan';
import { ClanRelationship } from './ClanRelationship';
import { Distinction } from './Distinction';
import { Family } from './Family';
import { Heritage } from './Heritage';
import { ICalculatable } from './ICalculatable';
import { MentorRelationship } from './MentorRelationship';
import { OtherRelationship } from './OtherRelationship';
import { ParentRelationship } from './ParentRelationship';
import { Passion } from './Passion';
import { Ring } from './Ring';
import { School } from './School';

export class Character {
    private models: CharacterCreationModels;
    // Model data
    public rings: Rings = {} as Rings;
    public skills: Skills = {} as Skills;

    // Techniques
    public techniques: App.Models.Character.Technique[] = [];

    // Items
    public items: App.Models.Character.Item[] = [];

    // Advntages and Disadvantages
    public distinctions: App.Models.Character.Advantage[] = [];
    public adversities: App.Models.Character.Disadvantage[] = [];
    public passions: App.Models.Character.Advantage[] = [];
    public anxieties: App.Models.Character.Disadvantage[] = [];

    // Social Status
    public status: number = 0;
    public honor: number = 0;
    public glory: number = 0;

    // Character data
    public clan: Clan | null = null;
    public family: Family | null = null;
    public school: School | null = null;
    public standOutRing: Ring | null = null;
    public clanRelationship: ClanRelationship | null = null;
    public bushido: Bushido | null = null;
    public distinction: Distinction | null = null;
    public adversity: Adversity | null = null;
    public passion: Passion | null = null;
    public anxiety: Anxiety | null = null;
    public mentor: MentorRelationship | null = null;
    public otherRelationships: OtherRelationship | null = null;
    public parentRelationship: ParentRelationship | null = null;
    public heritage: {
        one: Heritage;
        two: Heritage;
    } = {
        one: new Heritage(),
        two: new Heritage(),
    };

    // Personality and quirks etc.
    public lord: string = '';
    public giri: string = '';
    public ninjo: string = '';
    public firstNotice: string = '';
    public stress: string = '';
    public name: string = '';
    public death: string = '';

    public constructor(models: CharacterCreationModels) {
        this.models = models;

        this.models.rings.forEach((ring: App.Models.Core.Ring) => {
            this.rings[ring.key] = {
                ring: ring,
                rank: 1,
            };
        });

        this.models.skills.forEach((skill: App.Models.Core.Skill) => {
            this.skills[skill.key] = {
                skill: skill,
                rank: 0,
            };
        });

        this.recalculate();
    }

    private getCalculatables(): ICalculatable[] {
        let candidates: (ICalculatable | null)[] = [];
        candidates.push(this.clan);
        candidates.push(this.family);
        candidates.push(this.school);
        candidates.push(this.standOutRing);
        candidates.push(this.clanRelationship);
        candidates.push(this.bushido);
        candidates.push(this.distinction);
        candidates.push(this.adversity);
        candidates.push(this.passion);
        candidates.push(this.anxiety);
        candidates.push(this.mentor);
        candidates.push(this.otherRelationships);
        candidates.push(this.parentRelationship);
        candidates.push(this.heritage.one);
        candidates.push(this.heritage.two);

        let calculatables: ICalculatable[] = [];
        candidates.forEach((candidate) => {
            if (candidate === null) {
                return;
            }

            calculatables.push(candidate);
        });

        return calculatables;
    }

    private reset() {
        this.models.rings.forEach((ring: App.Models.Core.Ring) => (this.rings[ring.key].rank = 1));
        this.models.skills.forEach((skill: App.Models.Core.Skill) => (this.skills[skill.key].rank = 0));

        this.techniques = [];
        this.items = [];

        this.distinctions = [];
        this.adversities = [];
        this.passions = [];
        this.anxieties = [];

        this.status = 0;
        this.honor = 0;
        this.glory = 0;
    }

    public recalculate() {
        this.reset();

        for (const calculatable of this.getCalculatables()) {
            calculatable.getRingBonuses().forEach((bonus: RingBonus) => (this.rings[bonus.ring.key].rank += bonus.bonus));
            calculatable.getSkillBonuses().forEach((bonus: SkillBonus) => (this.skills[bonus.skill.key].rank += bonus.bonus));
            calculatable.getTechniques().forEach((technique: App.Models.Character.Technique) => this.techniques.push(technique));
            calculatable.getItems().forEach((item: App.Models.Character.Item) => this.items.push(item));
            calculatable.getDistinctions().forEach((distinction: App.Models.Character.Advantage) => this.distinctions.push(distinction));
            calculatable.getAdversities().forEach((adversity: App.Models.Character.Disadvantage) => this.adversities.push(adversity));
            calculatable.getPassions().forEach((passion: App.Models.Character.Advantage) => this.passions.push(passion));
            calculatable.getAnxieties().forEach((anxiety: App.Models.Character.Disadvantage) => this.anxieties.push(anxiety));

            // Social Stats
            calculatable.getStatusBonuses().forEach((bonus: number) => (this.status += bonus));
            calculatable.getGloryBonuses().forEach((bonus: number) => (this.glory += bonus));
            calculatable.getHonorBonuses().forEach((bonus: number) => (this.honor += bonus));
        }
    }

    public getSkillsWithRanks(): SkillValue[] {
        let skills: SkillValue[] = [];
        for (const [key, skill] of Object.entries(this.skills)) {
            if (skill.rank > 0) {
                skills.push(skill);
            }
        }

        return skills;
    }

    public getSkillsWithoutRanks(): App.Models.Core.Skill[] {
        let skills: App.Models.Core.Skill[] = [];
        for (const [key, skill] of Object.entries(this.skills)) {
            if (skill.rank === 0) {
                skills.push(skill.skill);
            }
        }

        return skills;
    }
}
