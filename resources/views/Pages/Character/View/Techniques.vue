<template>
    <div class="row column justify-center">
        <q-table :rows="techniques" :pagination="{ rowsPerPage: 50 }" class="q-mb-sm no-border-radius" dense hide-bottom />
    </div>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },
    computed: {
        techniques(): Object[] {
            let data: Object[] = [];
            for (const technique of this.character.techniques ?? []) {
                data.push({
                    name: technique.name,
                    type: technique.technique_subtype?.technique_type?.name ?? '',
                    subtype: technique.technique_subtype?.name,
                });
            }

            return data;
        },
    },
});
</script>
