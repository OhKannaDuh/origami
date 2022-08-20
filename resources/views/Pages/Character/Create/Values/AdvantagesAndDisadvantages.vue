<template>
    <q-expansion-item label="Advantages" v-if="showAdvantages">
        <q-list>
            <q-item v-for="item in character.distinctions" :key="item.key" dense>
                <q-item-section v-text="item.name" />
            </q-item>
            <q-item v-for="item in character.passions" :key="item.key" dense>
                <q-item-section v-text="item.name" />
            </q-item>
        </q-list>
    </q-expansion-item>

    <q-expansion-item label="Disadvantages" v-if="showDisadvantages">
        <q-list>
            <q-item v-for="item in character.adversities" :key="item.key" dense>
                <q-item-section v-text="item.name" />
            </q-item>
            <q-item v-for="item in character.anxieties" :key="item.key" dense>
                <q-item-section v-text="item.name" />
            </q-item>
        </q-list>
    </q-expansion-item>
</template>

<script lang="ts">
import { Character } from '@/ts/Data/Character';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },

    computed: {
        showAdvantages(): boolean {
            return this.character.distinctions.length > 0 || this.character.passions.length > 0;
        },
        showDisadvantages(): boolean {
            return this.character.adversities.length > 0 || this.character.anxieties.length > 0;
        },
    },
});
</script>
