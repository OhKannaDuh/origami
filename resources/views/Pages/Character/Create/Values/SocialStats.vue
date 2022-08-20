<template>
    <q-expansion-item v-if="show" label="Social Stats">
        <q-list>
            <q-item class="extra-dense">
                <data-label label="Status" :value="character.status" />
            </q-item>
            <q-item class="extra-dense">
                <data-label label="Honor" :value="character.honor" />
            </q-item>
            <q-item class="extra-dense">
                <data-label label="Glory" :value="character.glory" />
            </q-item>
        </q-list>
    </q-expansion-item>
</template>

<script lang="ts">
import DataLabel from './DataLabel.vue';
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { DataLabel },
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    computed: {
        show(): boolean {
            return this.character.status + this.character.honor + this.character.glory > 0;
        },
    },
});
</script>
