<template>
    <q-card-section v-if="character.heritage[heritage].entry">
        <div>
            <div v-if="entry.modifiers.honor !== 0">Honor: {{ entry.modifiers.honor }}</div>
            <div v-if="entry.modifiers.glory !== 0">Glory: {{ entry.modifiers.glory }}</div>
            <div v-if="entry.modifiers.status !== 0">Status: {{ entry.modifiers.status }}</div>
        </div>
    </q-card-section>
</template>

<script lang="ts">
import _ from 'lodash';
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
        heritage: {
            type: String,
            required: true,
        },
    },
    computed: {
        entry() {
            return this.character.heritage[this.heritage].entry;
        },
    },
});
</script>
