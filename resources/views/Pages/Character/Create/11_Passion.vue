<template>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 q-px-xs q-pb-xs" v-for="passion in models.passions" :key="passion.key">
            <q-card
                @click="update(passion)"
                :class="{ highlight: this.character.passion?.key === passion.key }"
                class="no-border-radius fill-height cursor-pointer"
            >
                <q-card-section>
                    <div class="text-h5 text-center" v-text="`${passion.name} (${passion.ring.name})`" />
                </q-card-section>
                <q-card-actions class="q-pa-none row">
                    <q-btn class="col-12 no-border-radius" label="Select" color="secondary" flat />
                </q-card-actions>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { Passion } from '@/ts/Data/Passion';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
        models: {
            type: Object as PropType<CharacterCreationModels>,
            required: true,
        },
    },
    methods: {
        valid() {
            return this.character.passion !== null;
        },
        getTitle: () => '11. What activity most makes your character feel at peace?',
        update(passion: App.Models.Character.Advantage) {
            this.character.passion = new Passion(passion);
            this.$emit('update');
        },
    },
});
</script>
