<template>
    <layout>
        <div class="row justify-left q-pt-xs">
            <div class="col-12 q-px-xs q-pb-xs">
                <q-card class="no-border-radius">
                    <q-card-actions class="text-center justify-around">
                        <Link as="span" :href="route('campaign.overview.show', { campaign: campaign.uuid })">
                            <q-btn label="Back" class="no-border-radius" color="accent" />
                        </Link>
                    </q-card-actions>
                </q-card>
            </div>

            <div class="col-12 q-px-xs q-pb-xs">
                <q-card class="no-border-radius">
                    <q-card-actions class="text-center justify-around">
                        <q-btn label="Add NPC" class="no-border-radius" color="accent" @click="dialog = !dialog" />
                        <q-btn label="Next" class="no-border-radius" color="accent" @click="next" />
                        <q-btn label="Setup Initiative" class="no-border-radius" color="accent" @click="drawer = !drawer" />
                    </q-card-actions>
                </q-card>
            </div>

            <div class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3" v-for="combatant in combatantsByInitiative" :key="combatant.uuid">
                <q-card class="no-border-radius fill-height" :class="{ highlight: isActive(combatant) }">
                    <q-card-section class="row">
                        {{ combatant.initiative }} - {{ combatant.name }}
                        <template v-if="combatant.isNpc">
                            <q-space />
                            <q-btn label="Clone" class="no-border-radius" color="accent" flat @click="cloneNpc(combatant)" />
                        </template>
                    </q-card-section>
                    <q-card-section>
                        <q-select v-model="combatant.stance" :options="['Air', 'Earth', 'Fire', 'Water', 'Void']" label="Stance" />
                    </q-card-section>

                    <q-card-section v-if="combatant.isNpc" class="row">
                        <q-input v-model="combatant.endurance" label="Endurance" readonly class="col-6" />
                        <q-input v-model="combatant.fatigue" label="Fatigue" class="col-6" />
                        <q-input v-model="combatant.composure" label="Composure" readonly class="col-6" />
                        <q-input v-model="combatant.strife" label="Strife" class="col-6" />
                    </q-card-section>

                    <q-card-section v-else class="row">
                        <q-input v-model="combatant.endurance" label="Endurance" readonly class="col-6" />
                        <q-input v-model="combatant.fatigue" label="Fatigue" readonly class="col-6" />
                        <q-input v-model="combatant.composure" label="Composure" readonly class="col-6" />
                        <q-input v-model="combatant.strife" label="Strife" readonly class="col-6" />
                    </q-card-section>

                    <q-card-section class="">
                        <div class="row fill-height">
                            <div class="row column col-12 justify-center" :class="{ 'q-pb-md': $q.screen.lt.lg }">
                                <div class="row justify-around">
                                    <div v-for="(rank, key) in combatant.rings" class="col-2" :key="key">
                                        <p class="no-margin text-center q-pa-sm">
                                            <i class="l5r-icon icon-2x" :class="`${key} color-${key}`" />
                                        </p>
                                        <p class="no-margin text-center no-height">
                                            <i class="ring-value" :class="`background-${key}`" v-html="rank" />
                                        </p>
                                        <q-tooltip :class="`background-${key}`" v-text="title(key)" self="top middle" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </q-card-section>
                </q-card>
            </div>
        </div>

        <q-drawer v-model="drawer" side="right" class="q-pa-xs" overlay>
            <q-item v-for="combatant in combatants" :key="combatant.uuid">
                <q-item-section v-text="combatant.name" />
                <q-item-section>
                    <q-input type="number" v-model="combatant.initiative" />
                </q-item-section>
            </q-item>
        </q-drawer>

        <q-dialog v-model="dialog" maximized>
            <q-card class="column">
                <q-card-section class="col-grow">
                    <q-input v-model="newCombatant.name" label="Name" />
                    <div class="row">
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.rings.air" label="Air" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.rings.earth" label="Earth" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.rings.fire" label="Fire" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.rings.water" label="Water" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.rings.void" label="Void" type="number" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.skills.artisan" label="Artisan" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.skills.martial" label="Martial" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.skills.scholar" label="Scholar" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.skills.social" label="Social" type="number" />
                        </div>
                        <div class="col-6 q-px-xs">
                            <q-input v-model="newCombatant.skills.trade" label="Trade" type="number" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 q-px-xs">
                            <q-input v-model="newCombatant.honor" label="Honor" type="number" />
                        </div>
                    </div>
                </q-card-section>
                <q-card-actions>
                    <q-btn
                        label="Close"
                        class="no-border-radius"
                        color="accent"
                        flat
                        @click="
                            () => {
                                resetCombatant();
                                dialog = !dialog;
                            }
                        "
                    />
                    <q-space />
                    <q-btn label="Add" class="no-border-radius" color="positive" flat @click="addNpc" />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </layout>
</template>

<script lang="ts">
import { Campaign } from '@/ts/Campaign/Campaign';
import Layout from '@/views/layouts/default.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { defineComponent, PropType, ref } from 'vue';
import { v4 as uuidv4 } from 'uuid';

export default defineComponent({
    components: { Layout, Link },
    props: {
        campaignData: {
            type: Object as PropType<App.Models.Core.Campaign>,
            required: true,
        },
    },

    setup(props) {
        const drawer = ref<boolean>(false);
        const dialog = ref<boolean>(false);
        const combatants = ref<Combatant[]>([]);
        const npcs = ref<CombatantNpc[]>([]);

        const newCombatant = ref<CombatantNpc>({
            name: '',
            rings: {
                air: 1,
                earth: 1,
                fire: 1,
                water: 1,
                void: 1,
            },
            skills: {
                artisan: 0,
                martial: 0,
                scholar: 0,
                social: 0,
                trade: 0,
            },
            honor: 0,
        });

        const campaign = ref<Campaign>(new Campaign(props.campaignData));

        for (const character of props.campaignData.characters ?? []) {
            combatants.value.push({
                name: character.name,
                uuid: character.uuid,
                initiative: 0,
                rings: character.stats.rings,
                skills: character.stats.skills,
                stance: 'Air',
                honor: character.stats.social.honor,
                isNpc: false,
                endurance: (parseInt(character.stats.rings.earth) + parseInt(character.stats.rings.fire)) * 2,
                fatigue: character.stats.conflict.fatigue,
                composure: (parseInt(character.stats.rings.earth) + parseInt(character.stats.rings.water)) * 2,
                strife: character.stats.conflict.strife,
            });
        }

        const active = ref<string>('');
        if (props.campaignData.characters?.length) {
            active.value = props.campaignData.characters[0].uuid;
        }

        return { drawer, dialog, combatants, npcs, newCombatant, campaign, active };
    },

    mounted() {
        this.campaign.addCharacterUpdateCallback((event: CampaignUpdateCharacterPayload) => {
            for (const combatant of this.combatants) {
                if (combatant.uuid === event.character.uuid) {
                    Object.assign(combatant, {
                        name: event.character.name,
                        uuid: event.character.uuid,
                        initiative: combatant.initiative,
                        rings: event.character.stats.rings,
                        skills: event.character.stats.skills,
                        stance: combatant.stance,
                        honor: event.character.stats.social.honor,
                        isNpc: false,
                        endurance: (parseInt(event.character.stats.rings.earth) + parseInt(event.character.stats.rings.fire)) * 2,
                        fatigue: event.character.stats.conflict.fatigue,
                        composure: (parseInt(event.character.stats.rings.earth) + parseInt(event.character.stats.rings.water)) * 2,
                        strife: event.character.stats.conflict.strife,
                    });
                }
            }
        });

        this.active = this.combatantsByInitiative[0].uuid;
    },

    methods: {
        resetCombatant() {
            this.newCombatant.name = '';

            this.newCombatant.rings.air = 1;
            this.newCombatant.rings.earth = 1;
            this.newCombatant.rings.fire = 1;
            this.newCombatant.rings.water = 1;
            this.newCombatant.rings.void = 1;

            this.newCombatant.skills.artisan = 0;
            this.newCombatant.skills.martial = 0;
            this.newCombatant.skills.scholar = 0;
            this.newCombatant.skills.social = 0;
            this.newCombatant.skills.trade = 0;

            this.newCombatant.honor = 0;
        },
        addNpc() {
            this.combatants.push({
                name: this.newCombatant.name,
                uuid: uuidv4(),
                initiative: 0,
                rings: this.newCombatant.rings,
                skills: this.newCombatant.skills,
                stance: 'Air',
                honor: this.newCombatant.honor,
                isNpc: true,
                endurance: (parseInt(this.newCombatant.rings.earth) + parseInt(this.newCombatant.rings.fire)) * 2,
                fatigue: 0,
                composure: (parseInt(this.newCombatant.rings.earth) + parseInt(this.newCombatant.rings.water)) * 2,
                strife: 0,
            });

            this.resetCombatant();

            this.dialog = !this.dialog;
        },
        title(key: string): string {
            return key.charAt(0).toUpperCase() + key.substr(1).toLowerCase();
        },
        isActive(combatant: Combatant): boolean {
            return this.active === combatant.uuid;
        },
        next() {
            let previous = this.active;
            let found = false;

            for (const combatant of this.combatantsByInitiative) {
                if (this.active !== previous) {
                    continue;
                }

                if (found) {
                    this.active = combatant.uuid;
                    found = false;
                }

                if (this.active === combatant.uuid) {
                    found = true;
                }
            }

            if (this.active === previous) {
                this.active = this.combatantsByInitiative[0].uuid;
            }
        },
        cloneNpc(combatant: Combatant) {
            let clone = { ...combatant };
            this.combatants.push(clone);
        },
    },
    computed: {
        combatantsByInitiative(): Combatant[] {
            return this.combatants.slice().sort((a, b) => {
                if (a.initiative === b.initiative) {
                    return a.honor - b.honor;
                }

                return b.initiative - a.initiative;
            });
        },
    },
});
</script>

<style lang="scss" scoped>
.ring-value {
    display: block;
    border-radius: 50%;
    height: 20px;
    width: 20px;
    position: relative;
    left: 50%;
    bottom: 20px;
}

.social-value {
    display: block;
    border-radius: 50%;
    position: relative;
    bottom: 40px;
}

.no-height {
    height: 0;
}
</style>
