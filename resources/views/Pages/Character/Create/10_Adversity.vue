<template>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 q-px-xs q-pb-xs" v-for="adversity in models.adversities" :key="adversity.key">
            <q-card
                @click="update(adversity)"
                :class="{ highlight: this.character.adversity?.key === adversity.key }"
                class="no-border-radius fill-height cursor-pointer"
            >
                <q-card-section>
                    <div class="text-h5 text-center" v-text="`${adversity.name} (${adversity.ring.name})`" />
                </q-card-section>
                <q-card-actions class="q-pa-none row">
                    <q-btn class="col-12 no-border-radius" label="Select" color="secondary" flat />
                </q-card-actions>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Adversity } from '@/ts/Data/Adversity';
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
            return this.character.adversity !== null;
        },
        getTitle: () => '10. What holds your character back the most in life?',
        update(adversity: App.Models.Character.Disadvantage) {
            this.character.adversity = new Adversity(adversity);
            this.$emit('update');
        },
    },
});
</script>
