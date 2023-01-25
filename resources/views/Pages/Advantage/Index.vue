<template>
    <layout>
        <div class="row q-mt-xs">
            <div class="q-px-xs q-pb-xs col-12">
                <q-card class="no-border-radius fill-height column">
                    <q-card-actions>
                        <q-select
                            class="col-12 col-sm-4 col-md-3 q-px-sm"
                            label="Category"
                            v-model="filter.type.model.value"
                            :options="filter.type.options"
                            clearable
                        />

                        <q-select
                            class="col-12 col-sm-4 col-md-3 q-px-sm"
                            label="Ring"
                            v-model="filter.ring.model.value"
                            :options="filter.ring.options"
                            clearable
                        />

                        <q-select
                            class="col-12 col-sm-4 col-md-3 q-px-sm"
                            label="Types"
                            v-model="filter.category.model.value"
                            :options="filter.category.options"
                            multiple
                        />
                    </q-card-actions>
                </q-card>
            </div>
            {{ filter.category.value }}
            <div v-for="advantage in filtered" :key="advantage.key" class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3">
                <q-card class="no-border-radius fill-height column">
                    <q-card-section class="text-weight-bold q-pb-none"> {{ advantage.name }} - ({{ advantage.ring.name }}) </q-card-section>

                    <q-card-section v-if="advantage.advantage_type" class="q-py-none text-small">
                        <span>Category: <i v-html="advantage.advantage_type.name" /></span>
                    </q-card-section>
                    <q-card-section v-if="advantage.advantage_categories" class="q-py-none text-small">
                        <span>Types: <i v-html="types(advantage)" /></span>
                    </q-card-section>

                    <q-card-section v-html="advantage.effects" />

                    <q-space />
                    <q-card-section v-if="advantage.source_book">
                        <span class="text-tiny">{{ advantage.source_book.name }} - page {{ advantage.page_number }}</span>
                    </q-card-section>
                </q-card>
            </div>
        </div>
    </layout>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue';
import Layout from '@/views/layouts/default.vue';
import DataLabel from '../Character/Create/Values/DataLabel.vue';
import { App } from '@/ts/models';

export default defineComponent({
    components: { Layout, DataLabel },
    props: {
        advantages: {
            type: Array as PropType<App.Models.Character.Advantage[]>,
            required: true,
        },
    },
    setup() {
        const filter = {
            type: {
                model: ref(null),
                options: ['Distinction', 'Passion'],
            },
            ring: {
                model: ref(null),
                options: ['Air', 'Earth', 'Fire', 'Water', 'Void'],
            },
            category: {
                model: ref([]),
                options: ['Interpersonal', 'Physical', 'Spiritual', 'Mental', 'Fame', 'Virtue'],
            },
        };

        return { filter };
    },
    methods: {
        types(advantage: App.Models.Character.Advantage): string {
            let types: string[] = [];
            for (const category of advantage.advantage_categories ?? []) {
                types.push(category.name);
            }

            return types.join(', ');
        },
        matchesTypeFilter(advantage: App.Models.Character.Advantage): boolean {
            let filter = this.filter.type.model.value;
            if (filter === null || filter === '') {
                return true;
            }

            if (advantage.advantage_type === null || advantage.advantage_type === undefined) {
                return false;
            }

            if (advantage.advantage_type.name !== filter) {
                return false;
            }

            return true;
        },
        matchesRingFilter(advantage: App.Models.Character.Advantage): boolean {
            let filter = this.filter.ring.model.value;
            if (filter === null || filter === '') {
                return true;
            }

            if (advantage.ring === null || advantage.ring === undefined) {
                return false;
            }

            if (advantage.ring.name !== filter) {
                return false;
            }

            return true;
        },
        matchesCategoryFilter(advantage: App.Models.Character.Advantage): boolean {
            let filter = this.filter.category.model.value;
            if (filter === []) {
                return true;
            }

            if (advantage.advantage_categories === null || advantage.advantage_categories === undefined) {
                return false;
            }

            let valid: boolean = true;
            for (const name of filter) {
                let has: boolean = false;
                for (const category of advantage.advantage_categories) {
                    if (category.name === name) {
                        has = true;
                    }
                }

                if (has === false) {
                    valid = false;
                }
            }

            return valid;
        },
    },
    computed: {
        filtered(): App.Models.Character.Advantage[] {
            let filtered: App.Models.Character.Advantage[] = [];
            for (const advantage of this.advantages) {
                if (!this.matchesTypeFilter(advantage)) {
                    continue;
                }

                if (!this.matchesRingFilter(advantage)) {
                    continue;
                }

                if (!this.matchesCategoryFilter(advantage)) {
                    continue;
                }

                filtered.push(advantage);
            }

            return filtered;
        },
    },
});
</script>
