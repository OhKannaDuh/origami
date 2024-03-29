<template>
    <q-card class="fill-height no-border-radius q-mb-xs">
        <q-expansion-item expand-separator label="Skill Increases">
            <q-card>
                <q-card-section v-for="(skills, key) in skillGroups" :key="key">
                    <p class="text-body q-ma-none" :class="{ 'text-secondary': skillGroupInCurriculum(key) }" v-text="key" />
                    <q-list>
                        <q-item v-for="(skill, index) in skills" :key="index" :clickable="canRankUp(skill.rank)" @click="advance(skill.key)">
                            <q-item-section class="text-left" :class="{ 'text-secondary': skillInCurriculum(skill.key) }">
                                {{ skill.name }} ({{ skill.rank }} -> {{ skill.rank + 1 }})
                            </q-item-section>
                            <q-item-section avatar :class="{ 'text-negative': !canRankUp(skill.rank) }"> {{ getCostToRankUp(skill.rank) }} </q-item-section>
                        </q-item>
                    </q-list>
                </q-card-section>
            </q-card>
        </q-expansion-item>
    </q-card>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { SchoolCurriculum, SchoolCurriculumRank } from '@/ts/data';
import { SkillRepository } from '@/ts/Repositories/SkillRepository';
import { defineComponent, PropType } from 'vue';

enum AdvancementType {
    Ring = 'ring',
    Skill = 'skill',
    Technique = 'technique',
    RankUp = 'rank_up',
}

export default defineComponent({
    emits: ['advance'],
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        repository: {
            type: Object as PropType<SkillRepository>,
            required: true,
        },
    },
    methods: {
        canRankUp(rank: string): boolean {
            let cost = this.getCostToRankUp(rank);

            return cost <= this.saved;
        },
        getCostToRankUp(rank: string) {
            return (parseInt(rank) + 1) * 2;
        },
        advance(key: string) {
            if (!this.character.stats.skills[key]) {
                this.character.stats.skills[key] = 0;
            }

            let rank: number = this.character.stats.skills[key];
            let cost: number = this.getCostToRankUp(rank.toString());
            this.character.advancements.advancements.push({
                type: AdvancementType.Skill,
                cost: cost,
                key: key,
            });

            this.character.advancements.xp.spent += cost;
            this.character.stats.skills[key]++;

            this.$emit('advance');
        },
        skillInCurriculum(key: string): boolean {
            let skill: App.Models.Core.Skill = this.repository.fromKey(key);
            let curriculum = this.getCurriculum();

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
        skillGroupInCurriculum(key: string): boolean {
            let curriculum = this.getCurriculum();
            key = key.toLowerCase();

            for (const rank of curriculum) {
                if (rank.type === 'skill-group' && rank.skill_group_key === key) {
                    return true;
                }
            }
            return false;
        },
        getCurriculum(): SchoolCurriculumRank[] {
            if (!this.character.school) {
                throw 'No Character School';
            }

            return this.character.school.curriculum[this.character.school_rank];
        },
    },

    computed: {
        saved() {
            return this.character.advancements.xp.total - this.character.advancements.xp.spent;
        },
        skillGroups(): { [key: string]: Object[] } {
            let data: { [key: string]: Object[] } = {};
            const characterSkills = this.character?.stats?.skills ?? {};
            const groups = this.repository.bySkillGroup();

            for (const [key, skills] of Object.entries(groups)) {
                skills.forEach((skill) => {
                    let rank = characterSkills[skill.key] ?? 0;
                    if (rank >= 5) {
                        return;
                    }

                    data[key] = data[key] ?? [];
                    data[key].push({
                        name: skill.name,
                        key: skill.key,
                        rank: rank,
                    });
                });
            }

            return data;
        },
    },
});
</script>

<style lang="scss" scoped>
.test {
    color: red !important;
}
</style>
