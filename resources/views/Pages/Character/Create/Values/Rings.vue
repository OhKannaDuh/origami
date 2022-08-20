<template>
    <q-expansion-item label="Rings">
        <q-list>
            <q-item v-for="item in rings" :key="item.ring.key" dense>
                <q-item-section avatar>
                    <i class="l5r-icon icon-lg" :class="`${item.ring.key} color-${item.ring.key}`" />
                </q-item-section>
                <data-label :label="item.ring.name" :value="item.rank" />
            </q-item>
        </q-list>
    </q-expansion-item>
</template>

<script lang="ts">
import DataLabel from './DataLabel.vue';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { DataLabel },
    props: {
        rings: Object as PropType<Rings>,
    },
});
</script>
