<template>
    <layout>
        <div class="row q-px-xs q-mt-xs justify-center">
            <form @submit.prevent="submit" class="fill-width" style="max-width: 600px">
                <q-card class="no-border-radius">
                    <q-card-section class="text-h6"> Create a Campaign </q-card-section>
                    <q-card-section>
                        <q-input
                            v-model="campaign.name"
                            :error="!!errors.name"
                            :error-message="errors.name"
                            label="Campaign Name"
                            @update:model-value="delete errors.name"
                        />
                    </q-card-section>
                    <q-card-section class="text-center">
                        <q-btn label="Create" type="submit" color="accent" flat dense class="no-border-radius" />
                    </q-card-section>
                </q-card>
            </form>
        </div>
    </layout>
</template>

<script lang="ts">
import Layout from '@/views/layouts/default.vue';
import { defineComponent, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default defineComponent({
    components: { Layout },
    setup() {
        const campaign = ref<{
            name: string;
        }>({ name: '' });

        const errors = ref<{ [key: string]: string }>({});

        return { campaign, errors };
    },

    methods: {
        submit() {
            Inertia.post(
                route('campaign.create.create'),
                { ...this.campaign },
                {
                    onError: (errors) => (this.errors = errors),
                }
            );
        },
    },
});
</script>
