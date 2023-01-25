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
            <div v-for="disadvantage in filtered" :key="disadvantage.key" class="q-px-xs q-pb-xs col-12 col-sm-6 col-md-4 col-lg-3">
                <q-card class="no-border-radius fill-height column">
                    <q-card-section class="text-weight-bold q-pb-none"> {{ disadvantage.name }} - ({{ disadvantage.ring.name }}) </q-card-section>

                    <q-card-section v-if="disadvantage.disadvantage_type" class="q-py-none text-small">
                        <span>Category: <i v-html="disadvantage.disadvantage_type.name" /></span>
                    </q-card-section>
                    <q-card-section v-if="disadvantage.disadvantage_categories" class="q-py-none text-small">
                        <span>Types: <i v-html="types(disadvantage)" /></span>
                    </q-card-section>

                    <q-card-section v-html="disadvantage.effects" />

                    <q-space />
                    <q-card-section v-if="disadvantage.source_book">
                        <span class="text-tiny">{{ disadvantage.source_book.name }} - page {{ disadvantage.page_number }}</span>
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
        disadvantages: {
            type: Array as PropType<App.Models.Character.Disadvantage[]>,
            required: true,
        },
    },
    setup() {
        const filter = {
            type: {
                model: ref(null),
                options: ['Adversity', 'Anxiety'],
            },
            ring: {
                model: ref(null),
                options: ['Air', 'Earth', 'Fire', 'Water', 'Void'],
            },
            category: {
                model: ref([]),
                options: ['Interpersonal', 'Physical', 'Spiritual', 'Mental', 'Scar', 'Curse', 'Infamy', 'Flaw'],
            },
        };

        return { filter };
    },
    methods: {
        types(disadvantage: App.Models.Character.Disadvantage): string {
            let types: string[] = [];
            for (const category of disadvantage.disadvantage_categories ?? []) {
                types.push(category.name);
            }

            return types.join(', ');
        },
        matchesTypeFilter(disadvantage: App.Models.Character.Disadvantage): boolean {
            let filter = this.filter.type.model.value;
            if (filter === null || filter === '') {
                return true;
            }

            if (disadvantage.disadvantage_type === null || disadvantage.disadvantage_type === undefined) {
                return false;
            }

            if (disadvantage.disadvantage_type.name !== filter) {
                return false;
            }

            return true;
        },
        matchesRingFilter(disadvantage: App.Models.Character.Disadvantage): boolean {
            let filter = this.filter.ring.model.value;
            if (filter === null || filter === '') {
                return true;
            }

            if (disadvantage.ring === null || disadvantage.ring === undefined) {
                return false;
            }

            if (disadvantage.ring.name !== filter) {
                return false;
            }

            return true;
        },
        matchesCategoryFilter(disadvantage: App.Models.Character.Disadvantage): boolean {
            let filter = this.filter.category.model.value;
            if (filter === []) {
                return true;
            }

            if (disadvantage.disadvantage_categories === null || disadvantage.disadvantage_categories === undefined) {
                return false;
            }

            let valid: boolean = true;
            for (const name of filter) {
                let has: boolean = false;
                for (const category of disadvantage.disadvantage_categories) {
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
        filtered(): App.Models.Character.Disadvantage[] {
            let filtered: App.Models.Character.Disadvantage[] = [];
            for (const disadvantage of this.disadvantages) {
                if (!this.matchesTypeFilter(disadvantage)) {
                    continue;
                }

                if (!this.matchesRingFilter(disadvantage)) {
                    continue;
                }

                if (!this.matchesCategoryFilter(disadvantage)) {
                    continue;
                }

                filtered.push(disadvantage);
            }

            return filtered;
        },
    },
});
</script>
