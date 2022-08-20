<template>
    <div class="row column justify-center">
        <template v-for="(group, key) in skillGroups" :key="key">
            <q-table :title="key" class="q-mb-xs no-border-radius" :rows="group" dense hide-header hide-bottom :pagination="{ rowsPerPage: 10 }" />
        </template>
    </div>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { SkillRepository } from '@/ts/Repositories/SkillRepository';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },
    async setup() {
        const repository = new SkillRepository();
        await repository.init();

        return { repository };
    },
    computed: {
        skillGroups() {
            let data: { [key: string]: Object[] } = {};
            const characterSkills = this.character?.stats?.skills ?? {};
            const groups = this.repository.bySkillGroup();

            for (const [key, skills] of Object.entries(groups)) {
                data[key] = data[key] ?? [];
                skills.forEach((skill) =>
                    data[key].push({
                        skill: skill.name,
                        rank: characterSkills[skill.key] ?? 0,
                    })
                );
            }

            return data;
        },
    },
});
</script>
