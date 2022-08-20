<template>
    <layout>
        <div class="row">
            <div class="col-12 col-sm-6 fill-height" :class="{ 'q-pa-sm': !mobile }">
                <character-details :character="character" />
            </div>
            <div class="col-12 col-sm-6 fill-height" :class="{ 'q-pa-sm': !mobile, 'ring-container': mobile, 'hide-socials': hideSocials }">
                <rings :character="character" :expand="hideSocials" @toggle="hideSocials = !hideSocials" />
            </div>
        </div>

        <!-- Mobile tabs -->
        <div class="row content-spacer" v-if="mobile" :class="{ expanded: !hideSocials }">
            <q-tab-panels v-model="tab.mobile" class="col-12 q-pa-xs">
                <q-tab-panel name="skills">
                    <Suspense>
                        <skills :character="character" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="conflict">
                    <Suspense>
                        <conflict :character="character" :saveManager="saveManager" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="advantages-and-disadvantages">
                    <Suspense>
                        <advantages-and-disadvantages :character="character" :saveManager="saveManager" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="inventory">
                    <Suspense>
                        <inventory :character="character" :saveManager="saveManager" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="techniques">
                    <Suspense>
                        <techniques :character="character" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="curriculum">
                    <Suspense>
                        <curriculum :character="character" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="personality">
                    <Suspense>
                        <personality :character="character" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="advancements">
                    <Suspense>
                        <advancements :character="character" :saveManager="saveManager" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="campaigns">
                    <Suspense>
                        <campaigns :character="character" />
                    </Suspense>
                </q-tab-panel>
                <q-tab-panel name="party" v-if="campaign">
                    <Suspense>
                        <party :campaign="campaign" />
                    </Suspense>
                </q-tab-panel>
            </q-tab-panels>
        </div>

        <div class="row content-spacer" v-else :class="{ expanded: !hideSocials }">
            <!-- Left tabs -->
            <div class="col-6 q-pa-sm">
                <q-card class="no-border-radius">
                    <q-tabs v-model="tab.desktop.left">
                        <q-tab v-for="(tab, key) in desktopTabsLeft" :key="key" :label="tab.label" :name="key" />
                    </q-tabs>
                </q-card>
                <q-tab-panels v-model="tab.desktop.left" class="col-12 q-pt-sm">
                    <q-tab-panel name="skills">
                        <Suspense>
                            <skills :character="character" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="conflict">
                        <Suspense>
                            <conflict :character="character" :saveManager="saveManager" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="curriculum">
                        <Suspense>
                            <curriculum :character="character" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="personality">
                        <Suspense>
                            <personality :character="character" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="campaigns">
                        <Suspense>
                            <campaigns :character="character" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="party" v-if="campaign">
                        <Suspense>
                            <party :campaign="campaign" />
                        </Suspense>
                    </q-tab-panel>
                </q-tab-panels>
            </div>

            <!-- Right tabs -->
            <div class="col-6 q-pa-sm">
                <q-card class="no-border-radius">
                    <q-tabs v-model="tab.desktop.right">
                        <q-tab v-for="(tab, key) in desktopTabsRight" :key="key" :label="tab.label" :name="key" />
                    </q-tabs>
                </q-card>

                <q-tab-panels v-model="tab.desktop.right" class="col-12 q-pt-sm">
                    <q-tab-panel name="advantages-and-disadvantages">
                        <Suspense>
                            <advantages-and-disadvantages :character="character" :saveManager="saveManager" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="inventory">
                        <Suspense>
                            <inventory :character="character" :saveManager="saveManager" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="techniques">
                        <Suspense>
                            <techniques :character="character" />
                        </Suspense>
                    </q-tab-panel>
                    <q-tab-panel name="advancements">
                        <Suspense>
                            <advancements :character="character" :saveManager="saveManager" />
                        </Suspense>
                    </q-tab-panel>
                </q-tab-panels>
            </div>
        </div>

        <!-- Fab -->
        <q-page-sticky :offset="[9, hideSocials ? 103 : 227]" v-if="mobile">
            <q-fab color="purple" icon="keyboard_arrow_up" direction="up" padding="sm">
                <q-fab-action
                    v-for="(item, key) in mobileTabs"
                    :key="key"
                    @click="tab.mobile = key"
                    :icon="item.icon"
                    :label="item.label"
                    color="primary"
                    external-label
                    label-position="left"
                />
            </q-fab>
        </q-page-sticky>

        <q-page-sticky position="top-right" :offset="[9, 9]" v-if="Object.entries(saveManager.queue).length > 0">
            <p class="no-margin text-center q-pa-xs save-icon bg-accent">
                <q-icon name="save" size="sm" />
            </p>

            <p class="no-margin text-center no-height">
                <i class="save-value bg-accent shadow-4 text-size-xs" v-html="Object.entries(saveManager.queue).length" />
            </p>
        </q-page-sticky>
    </layout>
</template>

<script lang="ts">
import Advancements from './View/Advancements.vue';
import AdvantagesAndDisadvantages from './View/AdvantagesAndDisadvantages.vue';
import Campaigns from './View/Campaigns.vue';
import CharacterDetails from './View/CharacterDetails.vue';
import Conflict from './View/Conflict.vue';
import Curriculum from './View/Curriculum.vue';
import Inventory from './View/Inventory.vue';
import Layout from '@/views/layouts/default.vue';
import Party from './View/Party.vue';
import Personality from './View/Personality.vue';
import Rings from './View/Rings.vue';
import Skills from './View/Skills.vue';
import Techniques from './View/Techniques.vue';
import { Campaign } from '@/ts/Campaign/Campaign';
import { Character } from '@/ts/Character/View/Character';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    components: {
        Advancements,
        AdvantagesAndDisadvantages,
        CharacterDetails,
        Curriculum,
        Inventory,
        Layout,
        Rings,
        Skills,
        Techniques,
        Personality,
        Campaigns,
        Party,
        Conflict,
    },
    props: {
        characterData: {
            type: Object as PropType<App.Models.Character.Character>,
            required: true,
        },
        campaignData: {
            type: Object as PropType<App.Models.Core.Campaign>,
            required: false,
        },
    },
    setup(props) {
        const tab = ref<{
            mobile: string;
            desktop: {
                left: string;
                right: string;
            };
        }>({
            mobile: 'conflict',
            desktop: {
                left: 'skills',
                // right: 'advantages-and-disadvantages',
                right: 'advancements',
            },
        });

        const character = ref<Character>(new Character(props.characterData));

        const mobileTabs = ref({
            skills: {
                label: 'Skills',
                icon: 'bar_chart',
            },
            conflict: {
                label: 'Conflict Mode',
                icon: 'priority_high',
            },
            'advantages-and-disadvantages': {
                label: 'Advantages & Disadvantages',
                icon: 'show_chart',
            },
            inventory: {
                label: 'Inventory',
                icon: 'work',
            },
            techniques: {
                label: 'Techniques',
                icon: 'add',
            },
            curriculum: {
                label: 'Curriculum',
                icon: 'question_mark',
            },
            personality: {
                label: 'Personality & Relationships',
                icon: 'person',
            },
            advancements: {
                label: 'Advancements',
                icon: 'add',
            },
        });

        const desktopTabsLeft = ref({
            skills: {
                label: 'Skills',
            },
            conflict: {
                label: 'Conflict Mode',
            },
            curriculum: {
                label: 'Curriculum',
            },
            personality: {
                label: 'Personality & Relationships',
            },
        });

        const desktopTabsRight = ref({
            'advantages-and-disadvantages': {
                label: 'Advantages & Disadvantages',
                icon: 'show_chart',
            },
            inventory: {
                label: 'Inventory',
            },
            techniques: {
                label: 'Techniques',
            },
            advancements: {
                label: 'Advancements',
            },
        });

        if (!props.campaignData) {
            desktopTabsLeft.value.campaigns = {
                label: 'Campaigns',
            };

            mobileTabs.value.campaigns = {
                label: 'Campaigns',
                icon: 'map',
            };
        } else {
            desktopTabsLeft.value.party = {
                label: 'Party',
            };

            mobileTabs.value.party = {
                label: 'Party',
                icon: 'people',
            };
        }

        const campaign = ref<Campaign>({} as Campaign);
        if (props.campaignData) {
            campaign.value = new Campaign(props.campaignData);
        }

        const hideSocials = ref<boolean>(true);
        const saveManager = ref<SaveManager>(new SaveManager());

        return { tab, character, mobileTabs, desktopTabsLeft, desktopTabsRight, campaign, hideSocials, saveManager };
    },
    computed: {
        mobile(): boolean {
            return this.$q.screen.lt.sm;
        },
    },
});
</script>

<style lang="scss" scoped>
.ring-container {
    z-index: 1000;
    position: fixed;
    bottom: 0px;
    width: calc(100%);
}

.hide-socials {
    bottom: -125px;
}

.content-spacer {
    margin-bottom: 168px;
    &.expanded {
        margin-bottom: 293px;
    }
}
.q-tab-panels {
    background: none;

    .q-tab-panel {
        padding: 0;
    }
}

.save-icon {
    display: block;
    border-radius: 50%;
}

.save-value {
    display: block;
    border-radius: 50%;
    height: 20px;
    width: 20px;
    position: relative;
    left: 60%;
    bottom: 15px;
}
</style>
