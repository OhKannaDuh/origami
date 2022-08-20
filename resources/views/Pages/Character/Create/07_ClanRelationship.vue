<template>
    <div class="row">
        <div class="col-12 col-sm-6 q-px-xs q-pb-xs">
            <q-card class="no-border-radius fill-height column cursor-pointer" @click="positive" :class="{ highlight: relationship.positive }">
                <q-card-section class="text-center">
                    Your character believes firmly in the precepts of their clan and the values it holds dear.
                </q-card-section>
                <q-card-section class="text-center col-grow column justify-center">
                    <span>+5 glory</span>
                </q-card-section>
                <q-card-actions class="q-pa-none row">
                    <q-btn class="col-12 no-border-radius" label="Select" color="secondary" flat />
                </q-card-actions>
            </q-card>
        </div>
        <div class="col-12 col-sm-6 q-px-xs q-pb-xs">
            <q-card class="no-border-radius fill-height" :class="{ highlight: !relationship.positive && relationship.skill }">
                <q-card-section class="text-center">
                    Your character has a fundamental disagreement with their clan's beliefs, policies or practifices and has defied these in the past.
                </q-card-section>
                <q-card-section class="text-center"> Gain 1 rank in a skill you have 0 ranks in </q-card-section>
                <q-card-section>
                    <q-select
                        v-model="relationship.skill"
                        :options="character.getSkillsWithoutRanks()"
                        option-value="key"
                        option-label="name"
                        @update:model-value="negative"
                    />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType, ref } from 'vue';
import { ClanRelationship } from '@/ts/Data/ClanRelationship';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    setup(props) {
        const relationship = ref<ClanRelationshipData>(
            props.character.clanRelationship ?? {
                positive: false,
            }
        );

        return { relationship };
    },
    methods: {
        valid() {
            return this.character.clanRelationship !== null;
        },
        getTitle: () => "07. What is your Character's relationship with their clan?",
        update() {
            this.character.clanRelationship = new ClanRelationship(this.relationship);
            this.$emit('update');
        },
        positive() {
            this.relationship.positive = true;
            this.relationship.skill = null;

            this.update();
        },
        negative() {
            this.relationship.positive = false;

            this.update();
        },
    },
});
</script>
