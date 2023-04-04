<template>
    <q-scroll-area class="fit">
        <q-list class="q-pa-sm">
            <q-item clickable @click="$emit('close')">
                <q-item-section avatar>
                    <q-icon name="chevron_right" />
                </q-item-section>
                <q-item-section>Close</q-item-section>
            </q-item>
            <q-separator />
            <q-card v-if="action" flat>
                <q-card-section class="q-pa-sm">
                    <h6 class="no-margin" v-text="action.name" />
                    <p class="no-margin text-subtitle2" v-text="action.conflictTypes.join(', ')" />
                    <p class="no-margin text-subtitle2" v-text="action.actionTypes.join(', ')" />
                </q-card-section>
                <q-card-section class="q-pa-sm">
                    <span><b>Activation: </b><span v-format="action.activation" /></span>
                </q-card-section>
                <q-card-section class="q-pa-sm">
                    <b>Effect: </b>
                    <template v-for="(effect, index) in action.effect" :key="index">
                        <span v-if="isActionEffectText(effect)" v-format="effect.effect" />
                        <q-list v-if="isActionEffectList(effect)">
                            <q-item v-for="(text, index) in effect.effects" :key="index">
                                <q-item-section>
                                    <span v-format="text" />
                                </q-item-section>
                            </q-item>
                        </q-list>
                    </template>
                </q-card-section>
                <q-card-section v-if="action.opportunities && action.opportunities.length" class="q-pa-sm">
                    <h6 class="no-margin">New Opportunities:</h6>
                    <q-list>
                        <q-item v-for="(opportunity, index) in action.opportunities" :key="index">
                            <span><b v-format="opportunity.cost" /><b>: </b><span v-format="opportunity.effect" /></span>
                        </q-item>
                    </q-list>
                </q-card-section>
            </q-card>
        </q-list>
    </q-scroll-area>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue';
import { Action, ActionEffect } from '@/ts/data';
import { ActionEffectType } from '@/ts/Data/ActionEffectType';

export default defineComponent({
    emits: ['close'],

    props: {
        args: {
            type: Object as PropType<{
                action: Action;
            }>,
            required: true,
        },
    },

    setup(props) {
        const action = ref<Action | null>(props.args.action);

        return { action };
    },

    methods: {
        isActionEffectText(effect: ActionEffect): boolean {
            return effect.type === ActionEffectType.TEXT;
        },
        isActionEffectList(effect: ActionEffect): boolean {
            return effect.type === ActionEffectType.LIST;
        },
    },
});
</script>
