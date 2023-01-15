<template>
    <layout>
        <div class="row justify-center" v-if="$page.props.auth.user">
            <div class="q-pa-xs col-12 col-md-6 col-lg-4">
                <q-card class="no-border-radius">
                    <q-card-section class="text-center">
                        <route :route="route('character.index.show')" color="accent" label="Characters" fit />
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Layout from '@/views/layouts/default.vue';
import axios from 'axios';

export default defineComponent({
    components: { Layout },

    mounted() {
        axios.get(route('api.user')).catch((error) => console.error(error));
    },
});
</script>
