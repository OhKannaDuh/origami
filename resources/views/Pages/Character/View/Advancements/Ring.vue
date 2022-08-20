<template>
    <q-card class="fill-height no-border-radius q-mb-xs">
        <q-expansion-item expand-separator label="Ring Increases">
            <q-card>
                <q-card-section class="text-center">
                    <q-btn
                        v-for="(rank, key) in character.stats.rings"
                        :key="key"
                        no-caps
                        class="q-ma-sm"
                        :disable="!canRankUp(rank.toString())"
                        @click="advance(key)"
                    >
                        <i :class="`l5r-icon icon-2x ${key} color-${key}`" />

                        <i class="q-pl-sm" :class="{ 'text-negative': !canRankUp(rank) }" v-text="getCostToRankUp(rank)" />
                    </q-btn>
                </q-card-section>
            </q-card>
        </q-expansion-item>
    </q-card>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { defineComponent, PropType } from 'vue';

enum AdvancementType {
    Ring = 'ring',
    Skill = 'skill',
    Technique = 'technique',
    RankUp = 'rank_up',
}

export default defineComponent({
    emits: ['advance'],
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },
    methods: {
        canRankUp(rank: string): boolean {
            if (parseInt(rank) >= 5) {
                return false;
            }

            let voidRank: number = this.character.stats.rings.void;
            let lowestRank = this.getLowestRing();
            if (parseInt(rank) + 1 > voidRank + parseInt(lowestRank)) {
                return false;
            }

            let cost = this.getCostToRankUp(rank);

            return cost <= this.saved;
        },
        getLowestRing(): number {
            let lowest = 5;
            for (const [key, rank] of Object.entries(this.character.stats.rings)) {
                if (rank < lowest) {
                    lowest = rank;
                }
            }

            return lowest;
        },
        getCostToRankUp(rank: string) {
            return (parseInt(rank) + 1) * 3;
        },
        advance(key: string) {
            let rank: number = this.character.stats.rings[key];
            let cost: number = this.getCostToRankUp(rank.toString());
            this.character.advancements.advancements.push({
                type: AdvancementType.Ring,
                cost: cost,
                key: key,
            });

            this.character.advancements.xp.spent += cost;
            this.character.stats.rings[key]++;

            this.$emit('advance');
        },
    },
    computed: {
        saved() {
            return this.character.advancements.xp.total - this.character.advancements.xp.spent;
        },
    },
});
</script>
