<template>
    <div class="row column justify-center">
        <q-table :rows="techniques" :pagination="{ rowsPerPage: 50 }" class="q-mb-sm no-border-radius" dense hide-bottom @row-click="show" />
    </div>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { App } from '@/ts/models';
import { defineComponent, PropType, ref } from 'vue';
import Drawer from '../../Drawers/Drawer.vue';

export default defineComponent({
    setup() {
        let current = ref<App.Models.Character.Technique | null>(null);

        return { current };
    },
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        drawer: {
            type: Object as PropType<typeof Drawer>,
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
    methods: {
        show(event: Event, row: Object, index: number) {
            if (!this.character.techniques) {
                return;
            }

            this.drawer.setContent('technique', {
                technique: this.character.techniques[index],
            });
        },
    },
});
</script>

<style lang="scss">
.p-inline p {
    display: inline;
}

.p-no-margin p {
    margin: 0;
}
</style>
