<template>
    <q-select v-model="items[index]" :options="effects[index].getChoices(models)" option-value="key" option-label="name" @update:model-value="update()" />
</template>

<script lang="ts">
import _ from 'lodash';
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { HeritageTable } from '@/ts/Data/HeritageTable';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
        models: {
            type: Object as PropType<CharacterCreationModels>,
            required: true,
        },
        heritage: {
            type: String,
            required: true,
        },
        table: {
            type: Object as PropType<HeritageTable>,
            required: true,
        },
    },
});
</script>
