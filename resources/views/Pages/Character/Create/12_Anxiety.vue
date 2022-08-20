<template>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 q-px-xs q-pb-xs" v-for="anxiety in models.anxieties" :key="anxiety.key">
            <q-card
                @click="update(anxiety)"
                :class="{ highlight: this.character.anxiety?.key === anxiety.key }"
                class="no-border-radius fill-height cursor-pointer"
            >
                <q-card-section>
                    <div class="text-h5 text-center" v-text="`${anxiety.name} (${anxiety.ring.name})`" />
                </q-card-section>
                <q-card-actions class="q-pa-none row">
                    <q-btn class="col-12 no-border-radius" label="Select" color="secondary" flat />
                </q-card-actions>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Anxiety } from '@/ts/Data/Anxiety';
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
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
            return this.character.anxiety !== null;
        },
        getTitle: () => '12. What conern, fear or foible troubles your character the most?',
        update(anxiety: App.Models.Character.Disadvantage) {
            this.character.anxiety = new Anxiety(anxiety);
            this.$emit('update');
        },
    },
});
</script>
