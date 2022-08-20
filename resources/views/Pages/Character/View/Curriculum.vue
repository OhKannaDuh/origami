<template>
    <div class="row column justify-center">
        <q-table
            v-for="(rank, index) in ranks"
            :key="index"
            :rows="rank"
            :columns="columns"
            :title="`Rank ${index}`"
            class="q-mb-xs no-border-radius"
            :class="{ highlight: character.school_rank == index }"
            :pagination="{ rowsPerPage: 7 }"
            dense
            hide-bottom
        />
    </div>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { SkillRepository } from '@/ts/Repositories/SkillRepository';
import { TechniqueRepository } from '@/ts/Repositories/TechniqueRepository';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },
    async setup() {
        const skills = ref<SkillRepository>(new SkillRepository());
        await skills.value.init();

        const techniques = ref<TechniqueRepository>(new TechniqueRepository());
        await techniques.value.init();

        return { skills, techniques };
    },
    methods: {
        getName(row: SchoolCurriculumRank): string {
            if (row.type === 'skill-group') {
                let name = row.skill_group_key;
                name = this.upperCase(name);

                return `${name} Skills`;
            }

            if (row.type === 'skill') {
                return this.skills.fromKey(row.skill_key).name;
            }

            if (row.type === 'technique-type' || row.type === 'technique-subtype') {
                let name = `Rank ${row.min_rank}`;
                if (row.min_rank !== row.max_rank) {
                    name += ` - ${row.max_rank}`;
                }

                return name + ` ${this.upperCase(row.technique_type_key ?? row.technique_subtype_key)}`;
            }

            if (row.type === 'technique') {
                let name = this.techniques.fromKey(row.technique_key).name;
                if (row.ignore_requirements) {
                    name = `<> ${name}`;
                }

                return name;
            }

            return '';
        },

        getType(row: SchoolCurriculumRank): string {
            let types: { [key: string]: string } = {
                'skill-group': 'Skill Group',
                skill: 'Skill',
                technique: 'Technique',
                'technique-type': 'Technique Group',
                'technique-subtype': 'Technique Group',
            };

            return types[row.type] ?? row.type;
        },

        upperCase(word: string): string {
            return word[0].toUpperCase() + word.substring(1);
        },
    },
    computed: {
        columns() {
            return [
                {
                    label: 'Advance',
                    field: (row: SchoolCurriculumRank) => this.getName(row),
                    align: 'left',
                },
                {
                    label: 'Type',
                    field: (row: SchoolCurriculumRank) => this.getType(row),
                    align: 'right',
                },
            ];
        },

        ranks() {
            let ranks: SchoolCurriculum = {};

            if (!this.character.school?.curriculum) {
                return ranks;
            }

            for (const [rank, curriculum] of Object.entries(this.character.school.curriculum)) {
                // if (parseInt(rank) >= this.character.school_rank) {
                ranks[rank] = curriculum;
                // }
            }

            return ranks;
        },
    },
});
</script>
