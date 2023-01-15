<template>
    <div class="row justify-center">
        <q-card class="fill-height no-border-radius q-mb-xs col-12">
            <q-card-section class="fill-height">
                <div class="row fill-height">
                    <div class="row col-12 justify-around">
                        <div class="col-4">
                            <p class="no-margin text-center no-height">Total</p>
                            <p class="no-margin text-center q-pa-sm" v-text="character.advancements.xp.total" />
                        </div>
                        <div class="col-4">
                            <p class="no-margin text-center no-height">Spent</p>
                            <p class="no-margin text-center q-pa-sm" v-text="character.advancements.xp.spent" />
                        </div>
                        <div class="col-4">
                            <p class="no-margin text-center no-height">Saved</p>
                            <p class="no-margin text-center q-pa-sm" v-text="saved" />
                        </div>
                    </div>
                </div>
            </q-card-section>
        </q-card>

        <div class="col-6 q-mb-xs q-pr-xs">
            <q-card class="fill-height no-border-radius">
                <q-card-actions class="q-pa-none column fill-height">
                    <div class="col-grow q-px-sm q-pt-sm column fill-height justify-center">
                        <q-input type="number" v-model="xp" label="Add Xp" />
                    </div>
                    <div class="fill-width">
                        <q-btn label="Add" color="accent" class="col-12 no-border-radius fill-width" @click="add" flat />
                    </div>
                </q-card-actions>
            </q-card>
        </div>

        <div class="col-6 q-mb-xs q-pl-xs">
            <q-card class="fill-height no-border-radius">
                <q-card-actions class="q-pa-none column fill-height">
                    <div class="col-grow q-px-sm q-pt-sm column fill-height justify-center">
                        <p class="no-margin text-center no-height">Spent in Curriculum</p>
                        <p class="no-margin text-center q-pa-sm" v-text="`${spentInCurriculum} (${requiredToRankUp})`" />
                    </div>
                    <div class="fill-width">
                        <q-btn
                            label="rankUp"
                            :disable="!canRankUp"
                            @click="rankUp"
                            class="col-12 no-border-radius fill-width"
                            :color="canRankUp ? 'positive' : 'negative'"
                            flat
                        />
                    </div>
                </q-card-actions>
            </q-card>
        </div>

        <q-card class="fill-height no-border-radius q-mb-xs col-12">
            <q-expansion-item expand-separator label="Current Advancements">
                <q-card>
                    <q-table
                        :rows="advancementRows"
                        :columns="[
                            {
                                label: 'Type',
                                field: (row) => typeText(row),
                                align: 'left',
                            },
                            {
                                label: 'Name',
                                field: 'name',
                                align: 'left',
                            },
                            {
                                label: 'Cost',
                                field: 'cost',
                            },
                            {
                                name: 'undo',
                                label: 'Undo',
                            },
                        ]"
                    >
                        <template #body-cell-undo="props">
                            <q-td class="text-right">
                                <q-btn label="Undo" @click="undo(props.rowIndex)" class="no-border-radius" color="negative" flat />
                            </q-td>
                        </template>
                    </q-table>
                </q-card>
            </q-expansion-item>
        </q-card>

        <ring :character="character" @advance="advance" class="col-12" />
        <skills :character="character" :repository="skills" @advance="advance" class="col-12" />
        <techniques :character="character" :repository="techniques" @advance="advance" class="col-12" />
    </div>
</template>

<script lang="ts">
import Ring from './Advancements/Ring.vue';
import Skills from './Advancements/Skills.vue';
import Techniques from './Advancements/Techniques.vue';
import { Character } from '@/ts/Character/View/Character';
import { RingRepository } from '@/ts/Repositories/RingRepository';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { SkillRepository } from '@/ts/Repositories/SkillRepository';
import { defineComponent, PropType, ref } from 'vue';
import { TechniqueRepository } from '@/ts/Repositories/TechniqueRepository';
import { AdvancementRow, SchoolCurriculumRank } from '@/ts/data';

enum AdvancementType {
    Ring = 'ring',
    Skill = 'skill',
    Technique = 'technique',
    RankUp = 'rank_up',
}

export default defineComponent({
    components: { Ring, Skills, Techniques },
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        saveManager: {
            type: Object as PropType<SaveManager>,
            required: true,
        },
    },
    async setup() {
        const xp = ref<string>('0');

        let rings = ref<RingRepository>(new RingRepository());
        await rings.value.init();

        let skills = ref<SkillRepository>(new SkillRepository());
        await skills.value.init();

        let techniques = ref<TechniqueRepository>(new TechniqueRepository());
        await techniques.value.init();

        return { xp, rings, skills, techniques };
    },
    methods: {
        add() {
            let xp = parseInt(this.xp);
            if (xp <= 0 || isNaN(xp)) {
                this.xp = '0';
                return;
            }

            this.character.advancements.xp.total += xp;
            this.saveManager.saveAdvancements(this.character);

            this.xp = '0';
        },
        advance() {
            this.saveManager.saveAdvancements(this.character);
        },
        skillInCurriculum(key: string, curriculum: SchoolCurriculumRank[]): boolean {
            let skill: App.Models.Core.Skill = this.skills.fromKey(key);

            for (const rank of curriculum) {
                if (rank.type === 'skill-group' && skill.skill_group?.key === rank.skill_group_key) {
                    return true;
                }

                if (rank.type === 'skill' && skill.key === rank.skill_key) {
                    return true;
                }
            }

            return false;
        },
        techniqueInCurriculum(key: string, curriculum: SchoolCurriculumRank[]): boolean {
            let technique: App.Models.Character.Technique = this.techniques.fromKey(key);
            for (const rank of curriculum) {
                if (rank.type === 'technique-type' && technique.technique_subtype?.technique_type?.key === rank.technique_type_key) {
                    return true;
                }

                if (rank.type === 'technique-subtype' && technique.technique_subtype?.key === rank.technique_subtype_key) {
                    return true;
                }

                if (rank.type === 'technique' && technique.key === rank.technique_key) {
                    return true;
                }
            }
            return false;
        },
        rankUp() {
            if (!this.canRankUp) {
                return;
            }

            this.character.advancements.advancements.push({
                type: AdvancementType.RankUp,
                cost: 0,
                key: '',
            });

            this.character.school_rank++;

            this.saveManager.saveAdvancements(this.character);
        },
        typeText(row: { type: string }): string {
            let words = [];
            for (const word of row.type.split('_')) {
                words.push(word.charAt(0).toUpperCase() + word.substr(1).toLowerCase());
            }

            return words.join(' ');
        },
        undo(index: number) {
            let advancement = this.character.advancements.advancements[index];
            if (advancement.type === AdvancementType.Ring) {
                this.character.stats.rings[advancement.key]--;
            }

            if (advancement.type === AdvancementType.Skill) {
                this.character.stats.skills[advancement.key]--;
            }

            if (advancement.type === AdvancementType.Technique && this.character.techniques) {
                let techniqueIndex = this.getTechniqueIndex(advancement.key);

                delete this.character.techniques[techniqueIndex];
                this.character.techniques = this.character.techniques.filter((item) => item);
            }

            if (advancement.type === AdvancementType.RankUp) {
                this.character.school_rank--;
            }

            this.character.advancements.xp.spent -= advancement.cost;

            delete this.character.advancements.advancements[index];
            this.character.advancements.advancements = this.character.advancements.advancements.filter((item) => item);

            this.saveManager.saveAdvancements(this.character);
        },
        getTechniqueIndex(key: string): number {
            let index = -1;
            for (const characterTechnique of this.character.techniques ?? []) {
                index++;
                if (characterTechnique.key === key) {
                    return index;
                }
            }

            return index;
        },
    },

    computed: {
        saved() {
            return this.character.advancements.xp.total - this.character.advancements.xp.spent;
        },
        spentInCurriculum(): number {
            if (!this.character.school) {
                return 0;
            }

            let spent: number = 0;
            let curriculum = this.character.school.curriculum[this.character.school_rank];

            for (const advancement of this.advancmentsSinceLastRankUp) {
                let cost = advancement.cost;
                let inCurriculum: boolean = false;

                if (advancement.type === AdvancementType.Skill) {
                    inCurriculum = this.skillInCurriculum(advancement.key, curriculum);
                }

                if (advancement.type === AdvancementType.Technique) {
                    inCurriculum = this.techniqueInCurriculum(advancement.key, curriculum);
                }

                if (!inCurriculum) {
                    cost = Math.ceil(cost / 2);
                }

                spent += cost;
            }

            return spent;
        },
        advancmentsSinceLastRankUp(): AdvancementRow[] {
            let data: AdvancementRow[] = [];
            let allAdvancements = [...this.advancementRows];
            allAdvancements.reverse();

            for (const advancement of allAdvancements) {
                if (advancement.type === AdvancementType.RankUp) {
                    return data;
                }

                data.push(advancement);
            }

            return data;
        },
        advancementRows(): AdvancementRow[] {
            let rows: AdvancementRow[] = [];
            for (const [index, item] of Object.entries(this.character.advancements.advancements)) {
                if (item.type === AdvancementType.Ring) {
                    rows.push({
                        type: AdvancementType.Ring,
                        name: this.rings.fromKey(item.key).name,
                        key: item.key,
                        cost: item.cost,
                    });
                }

                if (item.type === AdvancementType.Skill) {
                    rows.push({
                        type: AdvancementType.Skill,
                        name: this.skills.fromKey(item.key).name,
                        key: item.key,
                        cost: item.cost,
                    });
                }

                if (item.type === AdvancementType.Technique) {
                    rows.push({
                        type: AdvancementType.Technique,
                        name: this.techniques.fromKey(item.key).name,
                        key: item.key,
                        cost: item.cost,
                    });
                }

                if (item.type === AdvancementType.RankUp) {
                    rows.push({
                        type: AdvancementType.RankUp,
                        name: '',
                        key: '',
                        cost: 0,
                    });
                }
            }

            return rows;
        },
        requiredToRankUp(): number | null {
            let rank = this.character.school_rank;

            let ranks: { [key: number]: number } = {
                1: 20,
                2: 24,
                3: 32,
                4: 44,
                5: 60,
            };

            return ranks[rank] ?? null;
        },
        canRankUp(): boolean {
            return this.spentInCurriculum >= (this.requiredToRankUp ?? Infinity);
        },
    },
});
</script>
