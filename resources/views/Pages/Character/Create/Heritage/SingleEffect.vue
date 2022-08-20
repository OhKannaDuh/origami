<template>
    <template v-if="entry.effects[0] && entry.effects[0].advantage"> Advantage: {{ entry.effects[0].advantage.name }} </template>
    <template v-else-if="entry.effects[0] && entry.effects[0].item_type"> Item Type: {{ entry.effects[0].item_type.name }} </template>
    <template v-else-if="entry.effects[0] && entry.effects[0].fluff"> Description: {{ entry.effects[0].fluff }} </template>
    <template v-else>ERROR! TABLE NOT HANDLED</template>
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
