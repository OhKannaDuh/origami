<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section> Select a Family and ring below. </q-card-section>
            </q-card>
        </div>
    </div>

    <q-expansion-item v-if="character.clan" :label="`${character.clan.name} Families`" v-model="open">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 q-px-xs q-pb-xs" v-for="family in clanFamilies" :key="family.key">
                <family-card :family="family" :character="character" @update="update" />
            </div>
        </div>
    </q-expansion-item>

    <q-expansion-item label="Other Families">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 q-px-xs q-pb-xs" v-for="family in otherFamilies" :key="family.key">
                <family-card :family="family" :character="character" @update="update" />
            </div>
        </div>
    </q-expansion-item>
</template>

<script lang="ts">
import FamilyCard from './Components/FamilyCard.vue';
import { Character as CharacterData } from '@/ts/Data/Character';
import { Family } from '@/ts/Data/Family';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    emits: ['update'],
    components: { FamilyCard },
    props: {
        families: {
            type: Object as PropType<App.Models.Character.Family[]>,
            required: true,
        },
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    setup(props) {
        const clanFamilies = ref<App.Models.Character.Family[]>([]);
        const otherFamilies = ref<App.Models.Character.Family[]>([]);

        let clan: App.Models.Character.Clan | null = props.character.clan;
        for (const family of props.families) {
            if (family.clan?.key === clan?.key) {
                clanFamilies.value.push(family);
            } else {
                otherFamilies.value.push(family);
            }
        }

        const open = ref<boolean>(true);

        return {
            clanFamilies,
            otherFamilies,
            open,
        };
    },
    methods: {
        valid() {
            return this.character.family !== null;
        },
        getTitle: () => '02. What Family does your character belong to?',
        update(family: App.Models.Character.Family, ring: App.Models.Core.Ring) {
            this.character.family = new Family(family, ring);
            this.$emit('update');
        },
    },
});
</script>
