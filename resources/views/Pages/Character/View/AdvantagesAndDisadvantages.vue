<template>
    <div class="row column justify-center">
        <distinctions
            :character="character"
            :repository="advantages"
            :columns="columns"
            :saveManager="saveManager"
            @open="closeOthers"
            :ref="(el) => (references.distinctions = el)"
        />
        <adversities
            :character="character"
            :repository="disadvantages"
            :columns="columns"
            :saveManager="saveManager"
            @open="closeOthers"
            :ref="(el) => (references.adversities = el)"
        />
        <passions
            :character="character"
            :repository="advantages"
            :columns="columns"
            :saveManager="saveManager"
            @open="closeOthers"
            :ref="(el) => (references.passions = el)"
        />
        <anxieties
            :character="character"
            :repository="disadvantages"
            :columns="columns"
            :saveManager="saveManager"
            @open="closeOthers"
            :ref="(el) => (references.anxieties = el)"
        />
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

        const references = ref<Cloasables>({});

        return {
            advantages,
            disadvantages,
            columns,
            references,
        };
    },
    methods: {
        closeOthers(open: string) {
            for (const [key, item] of Object.entries(this.references)) {
                if (key === open) {
                    continue;
                }

                item.drawer = false;
            }
        },
    },
});
</script>
