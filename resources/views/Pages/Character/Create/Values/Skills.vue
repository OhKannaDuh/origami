<template>
    <q-expansion-item label="Skills" v-if="character.getSkillsWithRanks().length">
        <q-list>
            <q-item v-for="item in character.getSkillsWithRanks()" :key="item.skill.key" class="extra-dense">
                <data-label :label="item.skill.name" :value="item.rank" />
            </q-item>
        </q-list>
    </q-expansion-item>
</template>

<script lang="ts">
import DataLabel from './DataLabel.vue';
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    components: { DataLabel },
    props: {
        character: Object as PropType<CharacterData>,
    },
});
</script>
