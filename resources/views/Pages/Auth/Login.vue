<template>
    <layout>
        <div class="row q-pa-xs justify-center">
            <form @submit.prevent="submit" class="fill-width" style="max-width: 600px">
                <q-card class="no-border-radius bg-primary text-white">
                    <q-card-section class="text-h6"> Login </q-card-section>
                    <q-card-section>
                        <q-input v-model="user.email" :error="!!errors.email" :error-message="errors.email" label="Email" type="email" />
                        <q-input v-model="user.password" label="Password" type="password" />
                    </q-card-section>
                    <q-card-section class="text-right">
                        <q-btn label="Login" type="submit" color="accent" class="no-border-radius" />
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
        const user = ref<{
            email: string;
            password: string;
        }>({
            email: 'a@b.com',
            password: 'password',
        });

        const errors = ref<{ [key: string]: string }>({});

        return { user, errors };
    },

    methods: {
        submit() {
            Inertia.post(
                route('auth.login.login'),
                { ...this.user },
                {
                    onError: (errors) => (this.errors = errors),
                }
            );
        },
    },
});
</script>
