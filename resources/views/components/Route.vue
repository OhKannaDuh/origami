<template>
    <Link :href="route" as="span">
        <q-btn :label="label" :color="color" class="no-border-radius" flat :class="{ 'full-width': fit }" />
    </Link>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: { Link },
    props: {
        route: String,
        label: String,
        color: String,
        fit: {
            type: Boolean,
            default: false,
        },
    },
    setup() {},
});
</script>
