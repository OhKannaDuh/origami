<template>
    <layout>
        <div class="row justify-center">
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4" v-if="$page.props.auth.user">
                <q-card-section class="text-center">
                    <route :route="route('character.index.show')" color="accent" label="Characters" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4" v-if="$page.props.auth.user">
                <q-card-section class="text-center">
                    <route :route="route('campaign.index.show')" color="accent" label="Campaigns" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('source-book.index.show')" color="accent" label="Source Books" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('clan.index.show')" color="accent" label="Clans" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('family.index.show')" color="accent" label="Families" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('school.index.show')" color="accent" label="Schools" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('advantage.index.show')" color="accent" label="Advantages" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('disadvantage.index.show')" color="accent" label="Disadvantages" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('disadvantage.index.show')" color="accent" label="Techniques (nf)" fit />
                </q-card-section>
            </q-card>
            <q-card class="no-border-radius q-pa-xs q-ma-xs col-12 col-md-6 col-lg-4">
                <q-card-section class="text-center">
                    <route :route="route('disadvantage.index.show')" color="accent" label="Items (nf)" fit />
                </q-card-section>
            </q-card>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Layout from '@/views/layouts/default.vue';

export default defineComponent({
    components: { Layout },
});
</script>
