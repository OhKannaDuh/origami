<template>
    <div class="column justify-center">
        <q-card class="no-border-radius fill-height q-mb-xs" v-for="character in campaign.characters" :key="character.uuid">
            <q-card-section class="row q-pa-none fill-width">
                <q-avatar>
                    <img :src="character.avatar" />
                </q-avatar>
                <div class="column">
                    <p class="q-pl-sm q-ma-none text-body2" v-text="character.name" />
                    <p class="q-pl-sm q-ma-none text-caption" v-text="`${character.clan.name} - ${character.family.name}`" />
                    <p class="q-pl-sm q-ma-none text-caption" v-text="`${character.school.name} (${character.school_rank})`" />
                </div>
            </q-card-section>
            <q-card-section class="q-ma-none q-py-none">
                <span>
                    <span class="text-weight-bold">Fatigue</span>:
                    <span :class="{ 'text-negative': character.stats.conflict.fatigue >= endurance(character) }">
                        {{ character.stats.conflict.fatigue }}/{{ endurance(character) }}
                    </span>
                </span>
            </q-card-section>
            <q-card-section class="q-ma-none q-py-none">
                <span>
                    <span class="text-weight-bold">Strife</span>:
                    <span :class="{ 'text-negative': character.stats.conflict.strife >= composure(character) }">
                        {{ character.stats.conflict.strife }}/{{ composure(character) }}
                    </span>
                </span>
            </q-card-section>
            <q-card-section class="q-ma-none q-py-none">
                <span>
                    <span class="text-weight-bold">Void Points</span>:
                    <span :class="{ 'text-negative': character.stats.conflict.void_points <= 0 }">
                        {{ character.stats.conflict.void_points }}/{{ maxVoidPoints(character) }}
                    </span>
                </span>
            </q-card-section>
        </q-card>
    </div>
</template>

<script lang="ts">
import DataLabel from '../Create/Values/DataLabel.vue';
import { Campaign } from '@/ts/Campaign/Campaign';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { DataLabel },
    props: {
        campaign: {
            type: Object as PropType<Campaign>,
            required: true,
        },
    },
    methods: {
        endurance(character: App.Models.Character.Character) {
            return (character.stats.rings.earth + character.stats.rings.fire) * 2;
        },
        composure(character: App.Models.Character.Character) {
            return (character.stats.rings.earth + character.stats.rings.water) * 2;
        },
        focus(character: App.Models.Character.Character) {
            return character.stats.rings.air + character.stats.rings.fire;
        },
        vigilance(character: App.Models.Character.Character) {
            return Math.ceil((character.stats.rings.air + character.stats.rings.water) / 2);
        },
        maxVoidPoints(character: App.Models.Character.Character) {
            return character.stats.rings.void;
        },
    },
});
</script>

<style lang="scss" scoped>
.q-avatar {
    margin: 6px 6px 0px;
}
</style>
