<template>
    <div class="row column justify-center">
        <distinctions :character="character" :repository="advantages" :columns="columns" :saveManager="saveManager" @show="show" :drawer="drawer" />
        <adversities :character="character" :repository="disadvantages" :columns="columns" :saveManager="saveManager" @show="show" :drawer="drawer" />
        <passions :character="character" :repository="advantages" :columns="columns" :saveManager="saveManager" @show="show" :drawer="drawer" />
        <anxieties :character="character" :repository="disadvantages" :columns="columns" :saveManager="saveManager" @show="show" :drawer="drawer" />
    </div>
</template>

<script lang="ts">
import Adversities from './AdvantagesAndDisadvantages/Adversities.vue';
import Anxieties from './AdvantagesAndDisadvantages/Anxieties.vue';
import Distinctions from './AdvantagesAndDisadvantages/Distinctions.vue';
import Passions from './AdvantagesAndDisadvantages/Passions.vue';
import { AdvantageRepository } from '@/ts/Repositories/AdvantageRepository';
import { Character } from '@/ts/Character/View/Character';
import { DisadvantageRepository } from '@/ts/Repositories/DisadvantageRepository';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { defineComponent, PropType, ref } from 'vue';
import Drawer from '../../Drawers/Drawer.vue';

interface Cloasable {
    drawer: boolean;
}
interface Cloasables {
    distinctions?: Cloasable;
    adversities?: Cloasable;
    passions?: Cloasable;
    anxieties?: Cloasable;
}

export default defineComponent({
    components: {
        Adversities,
        Anxieties,
        Distinctions,
        Passions,
    },
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        saveManager: {
            type: Object as PropType<SaveManager>,
            required: true,
        },
        drawer: {
            type: Object as PropType<typeof Drawer>,
            required: true,
        },
    },
    async setup() {
        const advantages = ref<AdvantageRepository>(new AdvantageRepository());
        const disadvantages = ref<DisadvantageRepository>(new DisadvantageRepository());

        await advantages.value.init();
        await disadvantages.value.init();

        const columns = ref([
            {
                name: 'Name',
                field: 'name',
                align: 'left',
            },
            {
                name: 'Ring',
                field: (item: App.Models.Character.Advantage | App.Models.Character.Disadvantage) => item.ring?.name ?? 'ERROR',
                align: 'right',
            },
        ]);

        let current = ref<App.Models.Character.Advantage | App.Models.Character.Disadvantage | null>(null);

        return {
            advantages,
            disadvantages,
            columns,
            current,
        };
    },
    methods: {
        show(event: Event, object: App.Models.Character.Advantage | App.Models.Character.Disadvantage, index: number) {
            this.drawer.setContent('advantage-and-disadvantage', {
                current: object,
            });
        },
    },
});
</script>
