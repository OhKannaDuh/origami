<template>
    <layout>
        <div class="row q-mt-xs">
            <div v-for="book in books" :key="book.key" class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3">
                <q-card class="no-border-radius fill-height column">
                    <img src="https://via.placeholder.com/150" />
                    <q-card-section class="text-center text-weight-bold">
                        {{ book.name }}
                    </q-card-section>
                    <q-card-section>
                        <p class="q-ma-none"><span class="text-weight-bold">Clans</span>: {{ book.clans_count }}</p>
                        <p class="q-ma-none"><span class="text-weight-bold">Families</span>: {{ book.families_count }}</p>
                        <p class="q-ma-none"><span class="text-weight-bold">Techniques</span>: {{ book.techniques_count }}</p>
                        <p class="q-ma-none"><span class="text-weight-bold">Items</span>: {{ book.items_count }}</p>
                        <p class="q-ma-none"><span class="text-weight-bold">Schools</span>: {{ book.schools_count }}</p>
                        <p class="q-ma-none"><span class="text-weight-bold">Advantages</span>: {{ book.advantages_count }}</p>
                        <p class="q-ma-none"><span class="text-weight-bold">Disadvantages</span>: {{ book.disadvantages_count }}</p>
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

export default defineComponent({
    components: { Layout, DataLabel },
    props: {
        books: {
            type: Array as PropType<App.Models.Core.SourceBook[]>,
            required: true,
        },
    },
});
</script>
