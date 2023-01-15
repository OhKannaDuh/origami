<template>
    <q-card class="fill-height no-border-radius q-mb-xs">
        <q-expansion-item expand-separator label="Techniques">
            <q-card>
                <q-expansion-item v-for="(subtypeGroups, key) in availableTechniques" :key="key" expand-separator :label="types[key]" class="q-ml-sm">
                    <q-expansion-item
                        v-for="(techniques, key) in subtypeGroups"
                        :key="key"
                        expand-separator
                        :label="subtypes[key]"
                        class="q-ml-sm"
                        :header-class="{ 'text-secondary': techniqueSubtypeInCurriculum(key) }"
                    >
                        <q-list>
                            <q-item v-for="(technique, index) in techniques" :key="index" :clickable="canRankUp()" @click="advance(technique.key)">
                                <q-item-section class="text-left" :class="{ 'text-secondary': techniqueInCurriculum(technique.key) }">
                                    {{ technique.name }}
                                </q-item-section>
                                <q-item-section avatar :class="{ 'text-negative': !canRankUp(3) }"> {{ 3 }} </q-item-section>
                            </q-item>
                        </q-list>
                    </q-expansion-item>
                </q-expansion-item>
            </q-card>
        </q-expansion-item>
    </q-card>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { SchoolCurriculumRank } from '@/ts/data';
import { TechniqueRepository } from '@/ts/Repositories/TechniqueRepository';
import { defineComponent, PropType, ref } from 'vue';

enum AdvancementType {
    Ring = 'ring',
    Skill = 'skill',
    Technique = 'technique',
    RankUp = 'rank_up',
}

interface TechniueGroups {
    [key: string]: {
        [key: string]: App.Models.Character.Technique[];
    };
}

export default defineComponent({
    emits: ['advance'],
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        repository: {
            type: Object as PropType<TechniqueRepository>,
            required: true,
        },
    },
    setup() {
        const subtypes = ref<{ [key: string]: string }>({});
        const types = ref<{ [key: string]: string }>({});

        return { subtypes, types };
    },
    methods: {
        canRankUp(): boolean {
            return this.saved >= 3;
        },
        advance(key: string) {
            if (!this.character.techniques) {
                return;
            }

            this.character.advancements.advancements.push({
                type: AdvancementType.Technique,
                cost: 3,
                key: key,
            });

            this.character.advancements.xp.spent += 3;
            this.character.techniques.push(this.repository.fromKey(key));

            this.$emit('advance');
        },
        techniqueInCurriculum(key: string): boolean {
            let technique: App.Models.Character.Technique = this.repository.fromKey(key);
            let curriculum = this.getCurriculum();

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
        techniqueSubtypeInCurriculum(key: string): boolean {
            let curriculum = this.getCurriculum();

            for (const rank of curriculum) {
                if (rank.type === 'technique-subtype' && rank.technique_subtype_key === key) {
                    console.log(':D');
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
        availableTechniques(): TechniueGroups {
            let data: App.Models.Character.Technique[] = [];

            data = data.concat(this.schoolTypeTechniques);
            data = data.concat(this.schoolCurriculumTechniques);

            // remove duplicates
            data = [...new Set(data)];

            for (const technique of this.character.techniques ?? []) {
                let splice: number[] = [];
                let index: number = 0;
                for (const datum of data) {
                    if (datum.key === technique.key) {
                        splice.push(index);
                    }

                    index++;
                }

                splice.forEach((index) => data.splice(index, 1));
            }

            let group: TechniueGroups = {};
            for (const datum of data) {
                if (!datum.technique_subtype || !datum.technique_subtype.technique_type) {
                    continue;
                }

                let subtypeKey = datum.technique_subtype.key;
                let typeKey = datum.technique_subtype.technique_type.key;

                this.subtypes[subtypeKey] = datum.technique_subtype.name;
                this.types[typeKey] = datum.technique_subtype.technique_type.name;

                group[typeKey] = group[typeKey] ?? {};
                group[typeKey][subtypeKey] = group[typeKey][subtypeKey] ?? [];
                group[typeKey][subtypeKey].push(datum);
            }

            return group;
        },
        schoolTypeTechniques(): App.Models.Character.Technique[] {
            let data: App.Models.Character.Technique[] = [];
            let rank: number = this.character.school_rank;
            let types: App.Models.Core.TechniqueType[] = this.character.school?.available_technique_types ?? [];

            for (const type of types) {
                data = data.concat(this.repository.getByTypeAndRank(type, rank));
            }

            data.push(this.repository.fromKey('lord_akodos_roar'));
            return data;
        },
        schoolCurriculumTechniques(): App.Models.Character.Technique[] {
            let data: App.Models.Character.Technique[] = [];
            if (!this.character.school?.curriculum) {
                return data;
            }

            let rank: number = this.character.school_rank;
            for (const datum of this.character.school.curriculum[rank]) {
                if (datum.type !== 'technique' || datum.ignore_requirements === false) {
                    continue;
                }

                data.push(this.repository.fromKey(datum.technique_key));
            }

            return data;
        },
    },
});
</script>
