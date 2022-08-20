<template>
    <layout>
        <template #prebody>
            <q-linear-progress :value="progress" :color="progress < 1 ? 'secondary' : 'positive'" class="progress" />
        </template>
        <Suspense>
            <template #fallback> Loading... </template>
            <creator ref="creator" @update="(step) => (this.step = step)" />
        </Suspense>
    </layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import Layout from '@/views/layouts/default.vue';
import Creator from './Create/Creator.vue';

export default defineComponent({
    components: { Layout, Creator },
    setup() {
        const step = ref<number>(-1);

        return { step };
    },
    computed: {
        progress() {
            return this.step / 20;
        },
    },
});
</script>
