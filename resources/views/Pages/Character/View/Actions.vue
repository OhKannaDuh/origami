<template>
    <q-card class="no-border-radius fill-height">
        <q-card-section class="row">
            <div class="row col-6 q-pa-xs">
                <q-select v-model="actionTypeFilter" :options="actionTypes" clearable class="full-width" label="Action Type Filter" />
            </div>
            <div class="row col-6 q-pa-xs">
                <q-select v-model="conflictTypeFilter" :options="conflictTypes" clearable class="full-width" label="Conflict Type Filter" />
            </div>
        </q-card-section>
        <q-card-section class="row">
            <q-table :rows="rows" :columns="columns" class="full-width" flat hide-bottom :pagination="{ rowsPerPage: 10 }" @row-click="show" />
        </q-card-section>
    </q-card>
    <q-drawer v-model="drawer" elevated overlay side="right">
        <q-scroll-area class="fit">
            <q-list class="q-pa-sm">
                <q-item clickable @click="close">
                    <q-item-section avatar>
                        <q-icon name="chevron_right" />
                    </q-item-section>
                    <q-item-section>Close</q-item-section>
                </q-item>
                <q-separator />
                <q-card v-if="current" flat>
                    <q-card-section class="q-pa-sm">
                        <h6 class="no-margin" v-text="current.name" />
                        <p class="no-margin text-subtitle2" v-text="current.conflictTypes.join(', ')" />
                        <p class="no-margin text-subtitle2" v-text="current.actionTypes.join(', ')" />
                    </q-card-section>
                    <q-card-section class="q-pa-sm">
                        <span><b>Activation: </b><span v-format="current.activation" /></span>
                    </q-card-section>
                    <q-card-section class="q-pa-sm">
                        <b>Effect: </b>
                        <template v-for="(effect, index) in current.effect" :key="index">
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
                    <q-card-section v-if="current.opportunities" class="q-pa-sm">
                        <h6 class="no-margin">New Opportunities:</h6>
                        <q-list>
                            <q-item v-for="(opportunity, index) in current.opportunities" :key="index">
                                <span><b v-format="opportunity.cost" /><b>: </b><span v-format="opportunity.effect" /></span>
                            </q-item>
                        </q-list>
                    </q-card-section>
                </q-card>
            </q-list>
        </q-scroll-area>
    </q-drawer>
</template>

<script lang="ts">
import { Action, ActionEffect } from '@/ts/data';
import { ActionEffectType } from '@/ts/Data/ActionEffectType';
import { ActionType } from '@/ts/Data/ActionType';
import { ConflictType } from '@/ts/Data/ConflictType';
import { defineComponent, ref } from 'vue';

export default defineComponent({
    setup() {
        let current = ref<Action | null>(null);
        let drawer = ref<boolean>(false);

        let actions = ref<Action[]>([
            {
                name: 'Assist',
                actionTypes: [ActionType.ATTACK, ActionType.SCHEME, ActionType.SUPPORT],
                conflictTypes: [ConflictType.INTRIGUE, ConflictType.SKIRMISH],
                activation: 'As an Attack, Scheme, and support action, describe how you are helping one other character at range 0-2 with their next action.',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: "If the GM accepts your suggestion, you prove assistance on the chosen character's next action check.",
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Calming Breath',
                actionTypes: [ActionType.SUPPORT],
                conflictTypes: [ConflictType.INTRIGUE, ConflictType.DUEL, ConflictType.SKIRMISH],
                activation: 'As a support action, you may take a deep breath to calm yourself and recover stamina.',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'If your strife is greater than half your composure, you remove 1 strife. If your fatigue is greater than half your endurance, you remove 1 fatigue.',
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Center',
                actionTypes: [ActionType.SUPPORT],
                conflictTypes: [ConflictType.DUEL],
                activation:
                    'As a Support action in Void stance, you may focus your energy inward, envisioning your action in your mind and seeking the perfect moment to take it. You must name a skill when you use Center.',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'Roll a number of Skill dice up to your ranks in the skill you chose and reserve any number of those dice. If you do, the next time you make a check using the chosen skill (or use the Center action) this scene, after rolling dice, you may replace any number of rolled dice with the reserved dice (set to the results they were showing when reserved). You cannot reserve a number of dice greater than your ranks in the skill this way.',
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Predict',
                actionTypes: [ActionType.ATTACK, ActionType.SCHEME],
                conflictTypes: [ConflictType.DUEL],
                activation: 'As an Attack and Scheme action, you may secretly select Air, Earth, Fire, or Water and record it',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'The next time your opponent chooses their stance, you may reveal your selection; if it matches the stance they chose, your opponent receives 4 strife and must choose a different stance. Thi seffect persists until the end of your next turn.',
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Prepare Item',
                actionTypes: [ActionType.SUPPORT],
                conflictTypes: [ConflictType.DUEL, ConflictType.SKIRMISH],
                activation: 'As a Support action, you may use this action.',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'Prepare on item for use, ready a weapon in a grip of your choice, or stow an item.',
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Strike',
                actionTypes: [ActionType.ATTACK],
                conflictTypes: [ConflictType.DUEL, ConflictType.SKIRMISH],
                activation:
                    "As an Attack action using one readied weapon, you may make a TN 2 Martial Arts check using the appropriate skill for the weapon, targeting one character within the weapon's range.",
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: "If you succeed, you deal physical damage to the target equal to the weapon's base damage plus your bonus successes.",
                        effects: [],
                    },
                ],
                opportunities: [
                    {
                        cost: '{{opportunity}}{{opportunity}}',
                        effect: "If you succeed, inflict a critical strike on your target with severity equal to your weapon's deadliness.",
                    },
                ],
            },
            {
                name: 'Challenge',
                actionTypes: [ActionType.SCHEME],
                conflictTypes: [ConflictType.SKIRMISH],
                activation:
                    'As a Scheme action , you may make a TN 1 Command check to issue a formal combat challenge targeting one character at range 0-5. You must stake 10 honor and 5 glory upon the challenge, which you forfeit if you sabotage the clash.',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'If you succeed, the target must choose whether to accept or decline; resolve one of the following:',
                        effects: [],
                    },
                    {
                        type: ActionEffectType.LIST,
                        effect: '',
                        effects: [
                            'If the target **accepts**, they stake 10 honor and 5 glory, which they forfeit if they take any Attack or Scheme action before the cla sh. At the end of the round, the clash begins.',
                            'To **decline**, the target must forfeit glory equal to your ranks in Command plus your bonus successes. Each of their allies with lower glory than you suffers 2 strife. Then, you gain 1 Void point.',
                        ],
                    },
                    {
                        type: ActionEffectType.TEXT,
                        effect: "If you win the clash, each of your foe's allies in the skirmish suffers 3 strife. If you lose the clash, each of your allies suffers 3 strife.",
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Guard',
                actionTypes: [ActionType.SUPPORT],
                conflictTypes: [ConflictType.SKIRMISH],
                activation:
                    "As a Support action using a readied weapon, you may make a TN 1 Tactics check targeting yourself or one other character within the weapon's range.",
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'If you succeed, you guard the target until the beginning of your next turn. Increase the TN of Attack checks against the guarded target by one, plus an additional one per two bonus successes.',
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Maneuver',
                actionTypes: [ActionType.MOVEMENT],
                conflictTypes: [ConflictType.SKIRMISH],
                activation: 'As a Movement action, you may reposition for more distance. Optionally, you may make a TN 2 Fitness check as part of this aciton.',
                effect: [
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'Move one range band.',
                        effects: [],
                    },
                    {
                        type: ActionEffectType.TEXT,
                        effect: 'If you choose to make the Fitness check and you succeed, you may instead move two range bands, plus one additional range band per two bonus successes.',
                        effects: [],
                    },
                ],
                opportunities: [],
            },
            {
                name: 'Wait',
                actionTypes: [ActionType.SUPPORT],
                conflictTypes: [ConflictType.SKIRMISH],
                activation:
                    'As a Support action, you may declare a non-Movement action you will perform upon the occurrence of a specified event before the end of the round.',
                effect: [
                    {
                        type: ActionEffectType.LIST,
                        effect: '',
                        effects: [
                            'When the specified event occurs before the end of the round, you may perform the action. You must still use the ring matching your stance for this action.',
                            'If the specified event does not occur this round, you may perform one action of your choice (other than Wait) at the end of the round.',
                        ],
                    },
                ],
                opportunities: [],
            },
        ]);

        let actionTypeFilter = ref<ActionType | null>(null);
        let conflictTypeFilter = ref<ConflictType | null>(null);

        return { current, drawer, actions, actionTypeFilter, conflictTypeFilter };
    },

    computed: {
        rows(): Object[] {
            let rows: Object[] = [];

            for (const [index, action] of Object.entries(this.actions)) {
                if (this.actionTypeFilter !== null && !action.actionTypes.includes(this.actionTypeFilter)) {
                    continue;
                }

                if (this.conflictTypeFilter !== null && !action.conflictTypes.includes(this.conflictTypeFilter)) {
                    continue;
                }

                rows.push({
                    name: action.name,
                    types: action.actionTypes.join(', '),
                    conflicts: action.conflictTypes.join(', '),
                });
            }

            return rows;
        },
        columns(): Object[] {
            return [
                {
                    label: 'Name',
                    field: 'name',
                    align: 'left',
                },
                {
                    label: 'Action Types',
                    field: 'types',
                    align: 'left',
                },
                {
                    label: 'Conflict Types',
                    field: 'conflicts',
                    align: 'left',
                },
            ];
        },
        actionTypes(): string[] {
            return [ActionType.ATTACK, ActionType.MOVEMENT, ActionType.SCHEME, ActionType.SUPPORT];
        },
        conflictTypes(): string[] {
            return [ConflictType.INTRIGUE, ConflictType.DUEL, ConflictType.SKIRMISH];
        },
    },

    methods: {
        getActionByName(name: string): Action {
            for (const [index, action] of Object.entries(this.actions)) {
                if (action.name === name) {
                    return action;
                }
            }

            throw `No action with name ${name} found.`;
        },
        show(event: Event, row: { name: string }, index: number) {
            this.current = this.getActionByName(row.name);
            this.drawer = true;
        },
        close() {
            this.drawer = false;
        },
        isActionEffectText(effect: ActionEffect): boolean {
            return effect.type === ActionEffectType.TEXT;
        },
        isActionEffectList(effect: ActionEffect): boolean {
            return effect.type === ActionEffectType.LIST;
        },
    },
});
</script>
