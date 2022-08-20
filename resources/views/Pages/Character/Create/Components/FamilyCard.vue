<template>
    <q-card class="no-border-radius fill-height column" :class="{ highlight: hasChosenFamily(family) }">
        <!-- <q-img class="col" src="https://cdn.quasar.dev/img/parallax2.jpg" /> -->
        <q-card-section>
            <div class="text-h5" v-text="`The ${family.name} Family`" />
            <p class="q-ma-none">Skills: +1 {{ family.skill_one.name }}, +1 {{ family.skill_two.name }}</p>
            <p class="q-ma-none">Glory: {{ family.glory }}</p>
        </q-card-section>
        <q-card-section class="text-center"> Select a ring </q-card-section>
        <q-card-actions class="q-pa-none col-grow justify-end column fill-width">
            <div class="row fill-width">
                <q-btn
                    class="col-6 q-ma-none no-border-radius"
                    flat
                    unelevated
                    no-caps
                    :color="hasChosenFamily(family) && hasChosenRing(family.ring_choice_one) ? 'secondary' : ''"
                    @click="update(family, family.ring_choice_one)"
                >
                    +1 {{ family.ring_choice_one.name }}
                </q-btn>
                <q-btn
                    class="col-6 q-ma-none no-border-radius"
                    flat
                    unelevated
                    no-caps
                    :color="hasChosenFamily(family) && hasChosenRing(family.ring_choice_two) ? 'secondary' : ''"
                    @click="update(family, family.ring_choice_two)"
                >
                    +1 {{ family.ring_choice_two.name }}
                </q-btn>
            </div>
        </q-card-actions>
    </q-card>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { Family } from '@/ts/Data/Family';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        family: {
            type: Object as PropType<App.Models.Character.Family>,
            required: true,
        },
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    methods: {
        update(family: App.Models.Character.Family, ring: App.Models.Core.Ring) {
            this.character.family = new Family(family, ring);
            this.$emit('update', family, ring);
        },
        hasChosenFamily(family: App.Models.Character.Family): boolean {
            return this.character.family?.key === family.key;
        },
        hasChosenRing(ring: App.Models.Core.Ring): boolean {
            return this.character.family?.ring.key === ring.key;
        },
    },
});
</script>

<style lang="scss" scoped>
.q-card__actions--horiz > .q-btn-item + .q-btn-item,
.q-card__actions--horiz > .q-btn-group + .q-btn-item,
.q-card__actions--horiz > .q-btn-item + .q-btn-group {
    margin: 0;
}
</style>
