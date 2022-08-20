<template>
    <layout>
        <div class="row justify-center q-mt-xs">
            <div v-for="campaign in campaigns" :key="campaign.uuid" class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3">
                <q-card class="no-border-radius fill-height column">
                    <q-card-section class="col-grow">
                        <div>{{ campaign.name }}</div>
                        <div class="text-caption" v-text="`Characters (${campaign.characters_count})`" />
                    </q-card-section>
                    <q-card-actions class="q-pa-none">
                        <div class="row fill-width">
                            <Link :href="route('campaign.view.show', { campaign: campaign.uuid })" as="span" class="col-6">
                                <q-btn label="View" color="secondary" flat class="no-border-radius fill-width" />
                            </Link>
                            <q-btn label="Delete" color="negative" flat class="no-border-radius col-6" @click="deleteCampaign(campaign)" />
                        </div>
                    </q-card-actions>
                </q-card>
            </div>
            <div class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3 fill-height">
                <q-card class="no-border-radius fill-height column justify-center">
                    <q-card-actions class="q-pa-none">
                        <div class="row" style="width: 100%">
                            <Link :href="route('campaign.create.show')" as="span" class="col-12">
                                <q-btn label="New Campaign" color="accent" flat class="no-border-radius fill-width" />
                            </Link>
                        </div>
                    </q-card-actions>
                </q-card>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import Layout from '@/views/layouts/default.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default defineComponent({
    components: { Layout, Link },
    props: {
        campaigns: {
            type: Array as PropType<App.Models.Core.Campaign[]>,
            required: true,
        },
    },
    methods: {
        deleteCampaign(campaign: App.Models.Core.Campaign) {
            Inertia.post(route('campaign.delete.delete', { campaign: campaign.uuid }));
        },
    },
});
</script>
