<template>
    <layout>
        <div class="row justify-left q-pt-xs">
            <div class="col-12 q-px-xs q-pb-xs">
                <q-card class="no-border-radius">
                    <q-card-actions class="text-center justify-around">
                        <Link as="span" :href="route('campaign.view.show', { campaign: campaign.uuid })">
                            <q-btn label="Back" class="no-border-radius" color="accent" />
                        </Link>
                        <Link as="span" :href="route('campaign.conflict.show', { campaign: campaign.uuid })">
                            <q-btn label="Start Conflict" class="no-border-radius" color="accent" />
                        </Link>
                    </q-card-actions>
                </q-card>
            </div>

            <div class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3" v-for="character in campaign.characters" :key="character.uuid">
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

                    <q-card-section class="">
                        <div class="row fill-height">
                            <div class="row column col-12 justify-center" :class="{ 'q-pb-md': $q.screen.lt.lg }">
                                <div class="row justify-around">
                                    <div v-for="(rank, key) in character.stats.rings" class="col-2" :key="key">
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
    </layout>
</template>

<script lang="ts">
import Layout from '@/views/layouts/default.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { Layout, Link },
    props: {
        campaign: {
            type: Object as PropType<App.Models.Core.Campaign>,
            required: true,
        },
    },

    methods: {
        title(key: string): string {
            return key.charAt(0).toUpperCase() + key.substr(1).toLowerCase();
        },
    },
    computed: {},
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
