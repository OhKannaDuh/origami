<template>
    <q-select
        v-if="effect.choiceIsItem()"
        v-model="character.heritage[this.heritage].item"
        :options="effect.getChoices(models)"
        option-value="key"
        option-label="name"
    />
    <q-select
        v-else-if="effect.choiceIsTechnique()"
        v-model="character.heritage[this.heritage].technique"
        :options="effect.getChoices(models)"
        option-value="key"
        option-label="name"
    />
</template>

<script lang="ts">
import _ from 'lodash';
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType, ref } from 'vue';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
        heritage: {
            type: String,
            required: true,
        },
        models: {
            type: Object as PropType<CharacterCreationModels>,
            required: true,
        },
    },
    computed: {
        effect() {
            return this.character.heritage[this.heritage].effect;
        },
    },
});
</script>
