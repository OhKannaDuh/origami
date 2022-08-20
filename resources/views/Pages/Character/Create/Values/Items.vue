<template>
    <q-expansion-item label="Items" v-if="items.length">
        <q-list>
            <q-item v-for="item in items" :key="item.key" class="extra-dense">
                <q-item-section v-text="item.name" />
            </q-item>
        </q-list>
    </q-expansion-item>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        items: Object as PropType<App.Models.Character.Item[]>,
    },
});
</script>
