<template>
    <q-drawer v-model="state.open" elevated overlay side="right">
        <component v-if="content" :is="content" :args="args" @close="close" />
    </q-drawer>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import Action from './Action.vue';
import AdvantageAndDisadvantage from './AdvantageAndDisadvantage.vue';
import Adversities from './AdvantagesAndDisadvantages/Adversities.vue';
import Anxieties from './AdvantagesAndDisadvantages/Anxieties.vue';
import Distinctions from './AdvantagesAndDisadvantages/Distinctions.vue';
import Passions from './AdvantagesAndDisadvantages/Passions.vue';
import Technique from './Technique.vue';

export default defineComponent({
    components: {
        Action,
        AdvantageAndDisadvantage,
        Adversities,
        Anxieties,
        Distinctions,
        Passions,
        Technique,
    },

    setup() {
        const content = ref<string>('');
        const args = ref<Object>({});
        const state = ref<{ open: Boolean }>({ open: false });

        return { content, args, state };
    },

    methods: {
        setContent(content: string, args: Object = {}) {
            this.close();

            this.$nextTick(() => {
                this.state.open = true;

                this.content = content;
                this.args = args;
            });
        },

        close() {
            this.state.open = false;
            this.content = '';
        },
    },
});
</script>
