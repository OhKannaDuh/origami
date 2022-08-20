<template>
    <q-table
        title="Adversities"
        class="q-mb-xs no-border-radius"
        :rows="current"
        dense
        hide-header
        hide-bottom
        :pagination="{ rowsPerPage: 10 }"
        :columns="columns"
    >
        <template #top-right>
            <q-btn :label="drawer ? 'Close' : 'Manage'" class="no-border-radius" flat dense no-caps padding="0px 8px" color="accent" @click="toggleDrawer" />
        </template>
    </q-table>

    <q-drawer v-model="drawer" overlay elevated side="right">
        <q-scroll-area class="fit">
            <q-list>
                <q-item clickable @click="toggleDrawer">
                    <q-item-section avatar>
                        <q-icon name="chevron_right" />
                    </q-item-section>
                    <q-item-section>Close</q-item-section>
                </q-item>
                <q-separator />
                <q-item>
                    <q-item-section>
                        <q-input class="fit" v-model="filter" label="Filter" filled square />
                    </q-item-section>
                </q-item>
                <q-separator />
                <q-item v-for="item in filtered" :key="item.key" clickable @click="toggle(item)">
                    <q-item-section avatar>
                        <q-icon :name="character.getDisadvantageIndex(item) > -1 ? 'remove' : 'add'" />
                    </q-item-section>
                    <q-item-section> {{ item.name }} </q-item-section>
                </q-item>
            </q-list>
        </q-scroll-area>
    </q-drawer>
</template>

<script lang="ts">
import { DisadvantageRepository } from '@/ts/Repositories/DisadvantageRepository';
import { Character } from '@/ts/Character/View/Character';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    emits: ['open'],
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        repository: {
            type: Object as PropType<DisadvantageRepository>,
            required: true,
        },
        columns: Object,
        saveManager: {
            type: Object as PropType<SaveManager>,
            required: true,
        },
    },
    setup(props) {
        const current = ref<App.Models.Character.Disadvantage[]>(props.character.getDisadvantagesOfType('adversity'));
        const all = ref<App.Models.Character.Disadvantage[]>(props.repository.fromType('adversity'));

        const drawer = ref<boolean>(false);
        const filter = ref<string>('');

        return { current, all, drawer, filter };
    },
    methods: {
        toggleDrawer() {
            this.$emit('open', 'adversities');
            this.drawer = !this.drawer;
        },
        toggle(item: App.Models.Character.Disadvantage) {
            if (!this.character.disadvantages) {
                return;
            }

            let index: number = this.character.getDisadvantageIndex(item);
            if (index > -1) {
                this.character.disadvantages.splice(index, 1);
                this.current.splice(this.current.indexOf(item), 1);
            }

            if (index === -1) {
                this.character.disadvantages.push(item);
                this.current.push(item);
            }

            this.saveManager.saveDisadvantages(this.character);
        },
    },
    computed: {
        filtered(): App.Models.Character.Advantage[] {
            let filtered: App.Models.Character.Advantage[] = [];
            let filter = this.filter.trim().toUpperCase();
            if (!filter) {
                return this.all;
            }

            for (const subject of this.all) {
                if (subject.name.toUpperCase().includes(filter)) {
                    filtered.push(subject);
                }
            }

            return filtered;
        },
    },
});
</script>
