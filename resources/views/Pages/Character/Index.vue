<template>
    <layout>
        <div class="row justify-center q-mt-xs">
            <div v-for="character in characters" :key="character.uuid" class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3">
                <q-card class="no-border-radius fill-height column">
                    <q-card-section class="col-grow">
                        <div>{{ character.name }}</div>
                        <div
                            class="text-caption"
                            v-text="`${character.clan.name} - ${character.family.name} - ${character.school.name} (${character.school_rank})`"
                        />
                    </q-card-section>
                    <q-card-actions class="q-pa-none">
                        <div class="row fill-width">
                            <route :route="route('character.view.show', { character: character.uuid })" label="View" color="secondary" class="col-3" fit />
                            <route :route="route('character.update.show', { character: character.uuid })" label="Edit" color="secondary" class="col-3" fit />
                            <q-btn label="Copy" color="secondary" flat class="no-border-radius col-3" @click="copyCharacter(character)" />
                            <q-btn label="Delete" color="negative" flat class="no-border-radius col-3" @click="deleteCharacter(character)" />
                        </div>
                    </q-card-actions>
                </q-card>
            </div>
            <div class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3 fill-height">
                <q-card class="no-border-radius fill-height column justify-center">
                    <q-card-actions class="q-pa-none">
                        <div class="row" style="width: 100%">
                            <route :route="route('character.create.show')" label="New Character" color="accent" class="col-12" fit />
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
        characters: {
            type: Array as PropType<App.Models.Character.Character[]>,
            required: true,
        },
    },

    methods: {
        copyCharacter(character: App.Models.Character.Character) {
            Inertia.post(
                route('character.copy.copy', {
                    character: character.uuid,
                })
            );
        },
        deleteCharacter(character: App.Models.Character.Character) {
            Inertia.post(
                route('character.delete.delete', {
                    character: character.uuid,
                })
            );
        },
    },
});
</script>
