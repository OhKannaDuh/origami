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
                <q-card v-if="current" flat>
                    <q-card-section>
                        <h6 class="no-margin" v-text="current.name" />
                    </q-card-section>
                    <q-card-section v-if="current.description.activation">
                        <span><b>Activation: </b><span v-html="format(current.description.activation)" /></span>
                    </q-card-section>
                    <q-card-section v-if="current.description.effect">
                        <span><b>Effects: </b><span v-html="format(current.description.effect)" /></span>
                    </q-card-section>
                    <q-card-section v-if="current.description.opportunities">
                        <h6 class="no-margin">New Opportunities:</h6>
                        <q-list>
                            <q-item v-for="(opportunity, index) in current.description.opportunities" :key="index">
                                <span><b v-html="format(opportunity.cost)" /><b>: </b><span v-html="format(opportunity.effect)" /></span>
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
import { Formatter } from '@/ts/Character/Formatter';
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
        format(target: string): string {
            return this.formatter.format(target);
        },
    },
});
</script>
