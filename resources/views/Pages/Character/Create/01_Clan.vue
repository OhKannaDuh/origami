<template>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 q-px-xs q-pb-xs" v-for="clan in clans" :key="clan.key">
            <q-card @click="update(clan)" :class="{ highlight: this.character.clan?.key === clan.key }" class="no-border-radius cursor-pointer">
                <!-- <q-img class="col" src="https://cdn.quasar.dev/img/parallax2.jpg" /> -->
                <q-card-section>
                    <div class="text-h5" v-text="`The ${clan.name} Clan`" />
                    <p class="q-ma-none">Ring: +1 {{ clan.ring.name }}</p>
                    <p class="q-ma-none">Skill: +1 {{ clan.skill.name }}</p>
                    <p class="q-ma-none">Status: {{ clan.status }}</p>
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
import { Clan } from '@/ts/Data/Clan';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        clans: Object as PropType<App.Models.Character.Clan[]>,
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    methods: {
        valid() {
            return this.character.clan !== null;
        },
        getTitle: () => '01. What Clan does your character belong to?',
        update(clan: App.Models.Character.Clan) {
            this.character.clan = new Clan(clan);
            this.$emit('update');
        },
    },
});
</script>
