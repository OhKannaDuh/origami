<template>
    <q-scroll-area class="fit">
        <q-list class="q-pa-sm">
            <q-item clickable @click="$emit('close')">
                <q-item-section avatar>
                    <q-icon name="chevron_right" />
                </q-item-section>
                <q-item-section>Close</q-item-section>
            </q-item>
            <q-separator />
            <q-card v-if="technique" flat class="p-inline p-no-margin">
                <q-card-section>
                    <h6 class="no-margin" v-text="technique.name" />
                </q-card-section>
                <q-card-section v-if="technique.description.activation">
                    <span v-format="`<b>Activation:</b> ${technique.description.activation}`" />
                </q-card-section>
                <q-card-section v-if="technique.description.effect">
                    <span v-format="`<b>Effects:</b> ${technique.description.effect}`" />
                </q-card-section>
                <q-card-section v-if="technique.description.enhancement">
                    <span v-format="`<b>Enhancement Effect:</b> ${technique.description.enhancement}`" />
                </q-card-section>
                <q-card-section v-if="technique.description.burst">
                    <span v-format="`<b>Burst Effect:</b> ${technique.description.burst}`" />
                </q-card-section>
                <q-card-section v-if="technique.description.opportunities && technique.description.opportunities.length">
                    <h6 class="no-margin">New Opportunities:</h6>
                    <q-list>
                        <q-item v-for="(opportunity, index) in technique.description.opportunities" :key="index">
                            <span v-format="`<b>${opportunity.cost}:</b> ${opportunity.effect}`" />
                        </q-item>
                    </q-list>
                </q-card-section>
            </q-card>
        </q-list>
    </q-scroll-area>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    emits: ['close'],

    props: {
        args: {
            type: Object as PropType<{
                technique: App.Models.Character.Technique;
            }>,
            required: true,
        },
    },

    setup(props) {
        const technique = ref<App.Models.Character.Technique | null>(props.args.technique);

        return { technique };
    },
});
</script>
