<template>
    <q-item-section>
        <span>
            <span class="text-weight-bold">{{ label }}</span
            >: {{ value }}
        </span>
    </q-item-section>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        label: String,
        value: {},
    },
    setup() {},
});
</script>
