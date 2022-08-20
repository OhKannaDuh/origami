<template>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 q-px-xs q-pb-xs" v-for="ring in models.rings" :key="ring.key">
            <q-card @click="update(ring)" :class="{ highlight: this.character.standOutRing?.key === ring.key }" class="no-border-radius cursor-pointer">
                <!-- <q-img class="col" src="https://cdn.quasar.dev/img/parallax2.jpg" /> -->
                <q-card-section class="text-center">
                    {{ ring.name }}
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
import { Ring } from '@/ts/Data/Ring';
import { defineComponent, PropType } from 'vue';

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
            return this.character.standOutRing !== null;
        },
        getTitle: () => '04. How does your character stand out within their school?',
        update(ring: App.Models.Core.Ring) {
            this.character.standOutRing = new Ring(ring);
            this.$emit('update');
        },
    },
});
</script>
