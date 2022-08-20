<template>
    <layout>
        <div class="row justify-center q-mt-xs">
            <div class="q-px-xs q-pb-xsm col-12">
                <q-card class="no-border-radius">
                    <q-card-section>
                        <q-input v-model="name" label="Character Name" :error="!!errors.name" :error-message="errors.name" filled square />
                    </q-card-section>
                    <q-card-section class="row">
                        <q-avatar>
                            <img :src="image" />
                        </q-avatar>
                        <div class="column col-grow q-pa-sm">
                            <q-file v-model="avatar" label="Character Image" dense accept=".jpg, image/*" filled square />
                        </div>
                    </q-card-section>
                    <q-card-actions>
                        <q-space />
                        <q-btn label="Update" color="accent" class="no-border-radius" flat @click="update" />
                    </q-card-actions>
                </q-card>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import Layout from '@/views/layouts/default.vue';
import { Inertia } from '@inertiajs/inertia';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    components: { Layout },
    props: {
        character: {
            type: Object as PropType<App.Models.Character.Character>,
            required: true,
        },
    },
    setup(props) {
        const name = ref<string>(props.character.name);
        const avatar = ref();

        const errors = ref<{ [key: string]: string }>({});

        const image = ref<string>(props.character.avatar);

        return { avatar, name, errors, image };
    },
    methods: {
        update() {
            Inertia.post(
                route('character.update.update', {
                    character: this.character.uuid,
                }),
                {
                    name: this.name,
                    avatar: this.avatar,
                },
                {
                    onError: (errors) => (this.errors = errors),
                }
            );
        },
    },
    watch: {
        avatar() {
            this.image = URL.createObjectURL(this.avatar);
        },
    },
});
</script>
