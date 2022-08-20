<template>
    <q-expansion-item label="Techniques" v-if="techniques.length">
        <q-list>
            <q-item v-for="technique in techniques" :key="technique.key" class="extra-dense">
                <q-item-section v-text="technique.name" />
            </q-item>
        </q-list>
    </q-expansion-item>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        techniques: Object as PropType<App.Models.Character.Technique[]>,
    },
});
</script>
