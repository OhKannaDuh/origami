<template>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 q-px-xs q-pb-xs" v-for="distinction in models.distinctions" :key="distinction.key">
            <q-card
                @click="update(distinction)"
                :class="{ highlight: this.character.distinction?.key === distinction.key }"
                class="no-border-radius fill-height cursor-pointer column"
            >
                <q-card-section>
                    <div class="text-h5 text-center" v-text="`${distinction.name} (${distinction.ring.name})`" />
                </q-card-section>
                <q-space />
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
import { Distinction } from '@/ts/Data/Distinction';
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
            return this.character.distinction !== null;
        },
        getTitle: () => "09. What is your character's greatest accomplishment so far?",
        update(distinction: App.Models.Character.Advantage) {
            this.character.distinction = new Distinction(distinction);
            this.$emit('update');
        },
    },
});
</script>
