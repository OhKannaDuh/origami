<template>
    <div class="row column justify-center">
        <q-table :rows="techniques" :pagination="{ rowsPerPage: 50 }" class="q-mb-sm no-border-radius" dense hide-bottom @row-click="show" />
    </div>
    <q-drawer v-model="drawer" elevated overlay side="right">
        <q-scroll-area class="fit">
            <q-list class="q-pa-sm">
                <q-item clickable @click="close">
                    <q-item-section avatar>
                        <q-icon name="chevron_right" />
                    </q-item-section>
                    <q-item-section>Close</q-item-section>
                </q-item>
                <q-separator />
                <q-card v-if="current" flat class="p-inline p-no-margin">
                    <q-card-section>
                        <h6 class="no-margin" v-text="current.name" />
                    </q-card-section>
                    <q-card-section v-if="current.description.activation">
                        <span v-format="`<b>Activation:</b> ${current.description.activation}`" />
                    </q-card-section>
                    <q-card-section v-if="current.description.effect">
                        <span v-format="`<b>Effects:</b> ${current.description.effect}`" />
                    </q-card-section>
                    <q-card-section v-if="current.description.enhancement">
                        <span v-format="`<b>Enhancement Effect:</b> ${current.description.enhancement}`" />
                    </q-card-section>
                    <q-card-section v-if="current.description.burst">
                        <span v-format="`<b>Burst Effect:</b> ${current.description.burst}`" />
                    </q-card-section>
                    <q-card-section v-if="current.description.opportunities && current.description.opportunities.length">
                        <h6 class="no-margin">New Opportunities:</h6>
                        <q-list>
                            <q-item v-for="(opportunity, index) in current.description.opportunities" :key="index">
                                <span v-format="`<b>${opportunity.cost}:</b> ${opportunity.effect}`" />
                            </q-item>
                        </q-list>
                    </q-card-section>
                </q-card>
            </q-list>
        </q-scroll-area>
    </q-drawer>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { App } from '@/ts/models';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    setup() {
        let current = ref<App.Models.Character.Technique | null>(null);
        let drawer = ref<boolean>(false);

        return { current, drawer };
    },
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
    methods: {
        show(event: Event, row: Object, index: number) {
            if (!this.character.techniques) {
                return;
            }

            this.current = this.character.techniques[index];
            this.drawer = true;
        },
        close() {
            this.drawer = false;
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
