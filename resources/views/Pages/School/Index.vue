<template>
    <layout>
        <div class="row q-mt-xs">
            <div v-for="school in schools" :key="school.key" class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3">
                <q-card class="no-border-radius fill-height column">
                    <img src="https://via.placeholder.com/150" />
                    <q-card-section class="text-center text-weight-bold">
                        {{ school.name }}
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import Layout from '@/views/layouts/default.vue';
import DataLabel from '../Character/Create/Values/DataLabel.vue';
import { App } from '@/ts/models';

export default defineComponent({
    components: { Layout, DataLabel },
    props: {
        schools: {
            type: Array as PropType<App.Models.Character.School[]>,
            required: true,
        },
    },
});
</script>
