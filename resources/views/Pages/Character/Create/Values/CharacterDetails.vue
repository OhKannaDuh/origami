<template>
    <q-expansion-item label="Character Details" v-if="show">
        <q-item v-if="character.clan" class="extra-dense">
            <data-label label="Clan" :value="character.clan.name" />
        </q-item>

        <q-item v-if="character.family" class="extra-dense">
            <data-label label="Family" :value="character.family.name" />
        </q-item>
    </q-expansion-item>
</template>

<script lang="ts">
import DataLabel from './DataLabel.vue';
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { DataLabel },
    props: {
        character: Object as PropType<CharacterData>,
    },

    computed: {
        show(): boolean {
            return !!this.character?.clan || !!this.character?.family;
        },
    },
});
</script>
