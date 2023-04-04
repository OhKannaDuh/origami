<template>
    <q-table
        title="Anxieties"
        class="q-mb-xs no-border-radius"
        :rows="current"
        dense
        hide-header
        hide-bottom
        :pagination="{ rowsPerPage: 10 }"
        :columns="columns"
        @row-click="show"
    >
        <template #top-right>
            <q-btn label="Manage" class="no-border-radius" flat dense no-caps padding="0px 8px" color="accent" @click="manage" />
        </template>
    </q-table>
</template>

<script lang="ts">
import { DisadvantageRepository } from '@/ts/Repositories/DisadvantageRepository';
import { Character } from '@/ts/Character/View/Character';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { defineComponent, PropType, ref } from 'vue';
import Drawer from '../../Drawers/Drawer.vue';

export default defineComponent({
    emits: ['show'],

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
        drawer: {
            type: Object as PropType<typeof Drawer>,
            required: true,
        },
    },

    setup(props) {
        const current = ref<App.Models.Character.Disadvantage[]>(props.character.getDisadvantagesOfType('anxiety'));

        return { current };
    },

    methods: {
        show(event: Event, object: App.Models.Character.Disadvantage, index: number) {
            this.$emit('show', event, object, index);
        },

        manage() {
            this.drawer.setContent('anxieties', {
                character: this.character,
                repository: this.repository,
                saveManager: this.saveManager,
            });
        },
    },
});
</script>
