<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-select label="Heritage Table" v-model="table" :options="tables" option-value="key" option-label="name" @update:model-value="update" />
                </q-card-section>
            </q-card>
        </div>
        <div class="col-12 col-sm-6 q-px-xs q-pb-xs" v-for="(heritage, key) in character.heritage" :key="key">
            <q-card class="no-border-radius fill-height column">
                <entry :character="character" :models="models" :heritage="key" :table="table" />
                <social-stats :character="character" :heritage="key" />

                <!-- Effects -->
                <q-card-section v-if="character.heritage[key].entry">
                    <!-- Multple Effects -->
                    <template v-if="character.heritage[key].entry.hasMultipleEffects()">
                        <q-select
                            v-model="character.heritage[key].effect"
                            :options="character.heritage[key].entry.effects"
                            option-value="key"
                            option-label="name"
                            @update:model-value="update"
                        />
                    </template>
                    <!-- One Effect -->
                    <single-effect v-else :character="character" :heritage="key" />
                </q-card-section>

                <!-- Effect choice of Items or Techniques etc. -->
                <q-card-section v-if="character.heritage[key].effect && character.heritage[key].effect.hasMultipleChoices()">
                    <effect-choice :character="character" :heritage="key" :models="models" />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import EffectChoice from './Heritage/EffectChoice.vue';
import Entry from './Heritage/Entry.vue';
import SingleEffect from './Heritage/SingleEffect.vue';
import SocialStats from './Heritage/SocialStats.vue';
import _ from 'lodash';
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { CoreRulebookTable } from '@/ts/Data/HeritageTables/CoreRulebookTable';
import { FieldsOfVictoryTable } from '@/ts/Data/HeritageTables/FieldsOfVictoryTable';
import { HeritageTable } from '@/ts/Data/HeritageTable';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    components: { Entry, SocialStats, SingleEffect, EffectChoice },
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
    setup(props) {
        const tables = ref<HeritageTable[]>([]);
        tables.value.push(new CoreRulebookTable(props.models));
        tables.value.push(new FieldsOfVictoryTable(props.models));

        const table = ref<HeritageTable>(tables.value[0]);

        const validated = ref<boolean>(true);

        return { tables, table, validated };
    },
    methods: {
        valid() {
            return this.validated;
        },
        getTitle: () => '18. Who was your character named to honor?',
        update() {
            this.$emit('update');
        },
    },
    watch: {
        // One
        'character.heritage.one.entry'() {
            if (!this.character.heritage.one.entry) {
                return;
            }

            this.character.heritage.one.effect = null;
            if (!this.character.heritage.one.entry.hasMultipleEffects()) {
                this.character.heritage.one.effect = this.character.heritage.one.entry.effects[0];
            }

            this.update();
        },
        'character.heritage.one.effect'() {
            this.character.heritage.one.item = null;
            this.character.heritage.one.technique = null;

            this.update();
        },
        'character.heritage.one.item'() {
            this.update();
        },
        'character.heritage.one.technique'() {
            this.update();
        },
        // Two
        'character.heritage.two.entry'() {
            if (!this.character.heritage.two.entry) {
                return;
            }

            this.character.heritage.two.effect = null;
            if (!this.character.heritage.two.entry.hasMultipleEffects()) {
                this.character.heritage.two.effect = this.character.heritage.two.entry.effects[0];
            }

            this.update();
        },
        'character.heritage.two.effect'() {
            this.character.heritage.two.item = null;
            this.character.heritage.two.technique = null;

            this.update();
        },
        'character.heritage.two.item'() {
            this.update();
        },
        'character.heritage.two.technique'() {
            this.update();
        },
    },
});
</script>
