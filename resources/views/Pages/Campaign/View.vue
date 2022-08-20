<template>
    <layout>
        <div class="row justify-center" v-if="owner">
            <div class="col-12 q-px-xs q-pt-xs">
                <q-card class="no-border-radius">
                    <q-card-section class="text-center">
                        <Link as="span" :href="route('campaign.overview.show', { campaign: campaign.uuid })">
                            <q-btn label="Dms corner" class="no-border-radius" color="accent" />
                        </Link>
                    </q-card-section>
                </q-card>
            </div>
        </div>
        <div class="row justify-center">
            <div class="col-12 q-pa-xs">
                <q-card class="no-border-radius">
                    <template v-if="owner">
                        <q-card-section>
                            <q-input filled v-model="proxy.name" square label="Campaign Name" />
                        </q-card-section>
                        <q-card-section>
                            <q-input filled v-model="proxy.description" square label="Campaign Description" />
                        </q-card-section>
                        <q-card-actions v-if="dirty">
                            <q-space />
                            <q-btn label="Update" color="accent" class="no-border-radius" flat @click="update" />
                        </q-card-actions>
                    </template>
                    <q-card-section v-else>
                        {{ campaign.name }}
                    </q-card-section>
                </q-card>
            </div>

            <div class="col-12 q-px-xs q-pb-xs">
                <q-card class="no-border-radius">
                    <q-card-section>
                        <q-input filled v-model="invite" square label="Invite Link" readonly class="no-border">
                            <template #append>
                                <q-btn label="Copy" color="accent" class="no-border-radius" @click="copyInviteLink" />
                            </template>
                        </q-input>
                    </q-card-section>
                </q-card>
            </div>
        </div>
        <!-- Characters -->
        <div class="row justify-left">
            <div class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3" v-for="character in campaignCharacters" :key="character.uuid">
                <q-card class="no-border-radius">
                    <q-card-section class="row">
                        <q-avatar>
                            <img :src="character.avatar" />
                        </q-avatar>
                        <div class="column">
                            <p class="q-pl-sm q-ma-none text-body2" v-text="character.name" />
                            <p class="q-pl-sm q-ma-none text-caption" v-text="`${character.clan.name} - ${character.family.name}`" />
                            <p class="q-pl-sm q-ma-none text-caption" v-text="`${character.school.name} (${character.school_rank})`" />
                        </div>
                    </q-card-section>
                    <q-card-actions class="q-pa-none">
                        <div class="row" style="width: 100%">
                            <Link
                                v-if="ownsCharacter(character)"
                                :href="route('character.view.campaign', { character: character.uuid, campaign: campaign.uuid })"
                                as="span"
                                class="col-6"
                            >
                                <q-btn label="View" color="accent" flat class="no-border-radius fill-width" />
                            </Link>
                            <q-btn
                                v-if="owner || ownsCharacter(character)"
                                label="Remove"
                                color="negative"
                                flat
                                class="no-border-radius fill-width col-6"
                                @click="removeCharacter(character)"
                            />
                        </div>
                    </q-card-actions>
                </q-card>
            </div>
        </div>

        <!-- Add character -->
        <div class="row justify-center">
            <div class="col-12 q-px-xs q-pb-xs">
                <q-card class="no-border-radius q-mb-xs">
                    <q-card-section> Add a Character </q-card-section>
                    <template v-if="charactersNotInCampaign.length">
                        <q-card-section>
                            <q-select v-model="character" :options="charactersNotInCampaign" option-label="name" option-value="uuid" />
                        </q-card-section>
                    </template>
                    <q-card-section v-else> Looks like you don't have any characters to add to this campaign. </q-card-section>

                    <q-card-actions>
                        <Link :href="route('character.create.show')" as="span">
                            <q-btn label="Create a Character" color="secondary" class="no-border-radius" flat />
                        </Link>
                        <q-space />
                        <q-btn v-if="character" label="Add" color="accent" class="no-border-radius" flat @click="addCharacter(character)" />
                    </q-card-actions>
                </q-card>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import Layout from '@/views/layouts/default.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { copyToClipboard } from 'quasar';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    components: { Layout, Link },
    props: {
        campaign: {
            type: Object as PropType<App.Models.Core.Campaign>,
            required: true,
        },
        characters: {
            type: Array as PropType<App.Models.Character.Character[]>,
            required: true,
        },
    },
    setup(props) {
        const proxy = ref<App.Models.Core.Campaign>({ ...props.campaign });
        const character = ref<App.Models.Character.Character | null>(null);

        const invite = ref<string>(
            route('campaign.join.join', {
                campaign: props.campaign.uuid,
            })
        );

        return { proxy, character, invite };
    },
    methods: {
        update() {
            Inertia.post(route('campaign.update.update', { campaign: this.campaign.uuid }), { ...this.proxy });
        },
        ownsCharacter(character: App.Models.Character.Character): boolean {
            return character.user_id === this.$page.props.auth.user.id;
        },
        removeCharacter(character: App.Models.Character.Character) {
            Inertia.post(
                route('campaign.update.remove', {
                    campaign: this.campaign.uuid,
                    character: character.uuid,
                })
            );
        },
        addCharacter(character: App.Models.Character.Character) {
            Inertia.post(
                route('campaign.update.add', {
                    campaign: this.campaign.uuid,
                    character: character.uuid,
                }),
                {},
                {
                    onSuccess: () => (this.character = null),
                }
            );
        },
        isCharacterInCampaign(character: App.Models.Character.Character): boolean {
            for (const campaignCharacter of this.campaignCharacters) {
                if (campaignCharacter.uuid === character.uuid) {
                    return true;
                }
            }

            return false;
        },
        copyInviteLink() {
            copyToClipboard(this.invite);
        },
    },
    computed: {
        owner(): boolean {
            return this.campaign.user_id === this.$page.props.auth.user.id;
        },
        dirty(): boolean {
            return this.campaign.name !== this.proxy.name || this.campaign.description !== this.proxy.description;
        },
        campaignCharacters(): App.Models.Character.Character[] {
            return this.campaign.characters ?? [];
        },
        charactersNotInCampaign(): App.Models.Character.Character[] {
            let characters: App.Models.Character.Character[] = [];
            for (const character of this.characters) {
                if (this.isCharacterInCampaign(character)) {
                    continue;
                }

                characters.push(character);
            }

            return characters;
        },
    },
});
</script>

<style lang="scss">
.q-field--filled.q-field--readonly .q-field__control:before {
    border: none !important;
}
</style>
