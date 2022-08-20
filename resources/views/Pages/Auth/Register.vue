<template>
    <layout>
        <div class="row q-px-xs q-pt-xs justify-center">
            <form @submit.prevent="submit" class="fill-width" style="max-width: 600px">
                <q-card class="no-border-radius">
                    <q-card-section class="text-h6"> Register </q-card-section>
                    <q-card-section>
                        <q-input
                            v-model="user.name"
                            :error="!!errors.name"
                            :error-message="errors.name"
                            label="Username"
                            @update:model-value="delete errors.name"
                        />
                        <q-input
                            v-model="user.email"
                            :error="!!errors.email"
                            :error-message="errors.email"
                            label="Email"
                            type="email"
                            @update:model-value="delete errors.email"
                        />
                        <q-input
                            v-model="user.password"
                            :error="!!errors.password"
                            :error-message="errors.password"
                            label="Password"
                            type="password"
                            @update:model-value="delete errors.password"
                        />
                        <q-input v-model="user.password_confirmation" label="Confirm Password" type="password" />
                    </q-card-section>
                    <q-card-section class="text-right">
                        <q-btn label="Register" type="submit" color="accent" class="no-border-radius" />
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
            name: string;
            email: string;
            password: string;
            password_confirmation: string;
        }>({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        });

        const errors = ref<{ [key: string]: string }>({});

        return { user, errors };
    },

    methods: {
        submit() {
            Inertia.post(
                route('auth.register.show'),
                { ...this.user },
                {
                    onError: (errors) => (this.errors = errors),
                }
            );
        },
    },
});
</script>
