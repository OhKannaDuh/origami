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
            <q-card v-if="current" flat class="p-inline p-no-margin">
                <q-card-section>
                    <h6 class="no-margin" v-text="current.name" />
                </q-card-section>
                <q-card-section v-if="current.effects">
                    <span v-format="current.effects" />
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
                current: App.Models.Character.Advantage | App.Models.Character.Disadvantage;
            }>,
            required: true,
        },
    },

    setup(props) {
        let current = ref<App.Models.Character.Advantage | App.Models.Character.Disadvantage | null>(props.args.current);

        return { current };
    },
});
</script>
