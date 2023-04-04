<template>
    <q-scroll-area class="fit">
        <q-list>
            <q-item clickable>
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
                    <q-icon :name="character.getAdvantageIndex(item) > -1 ? 'remove' : 'add'" />
                </q-item-section>
                <q-item-section> {{ item.name }} </q-item-section>
            </q-item>
        </q-list>
    </q-scroll-area>
</template>

<script lang="ts">
import { AdvantageRepository } from '@/ts/Repositories/AdvantageRepository';
import { Character } from '@/ts/Character/View/Character';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    emits: ['close'],

    props: {
        args: {
            type: Object as PropType<{
                character: Character;
                repository: AdvantageRepository;
                saveManager: SaveManager;
            }>,
            required: true,
        },
    },

    setup(props) {
        const current = ref<App.Models.Character.Advantage[]>(props.args.character.getAdvantagesOfType('passion'));
        const all = ref<App.Models.Character.Advantage[]>(props.args.repository.fromType('passion'));

        const character = ref<Character>(props.args.character);

        const filter = ref<string>('');

        return { current, all, character, filter };
    },

    methods: {
        toggle(item: App.Models.Character.Advantage) {
            if (!this.character.advantages) {
                return;
            }

            let index: number = this.character.getAdvantageIndex(item);
            if (index > -1) {
                this.character.advantages.splice(index, 1);
                this.current.splice(this.current.indexOf(item), 1);
            }

            if (index === -1) {
                this.character.advantages.push(item);
                this.current.push(item);
            }

            this.args.saveManager.saveAdvantages(this.character);
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
