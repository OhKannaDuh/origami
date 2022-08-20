<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-input label="Your Personal Name" v-model="character.name" @update:model-value="update" />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    methods: {
        valid() {
            return this.character.name !== '';
        },
        getTitle: () => "19. What is your character's personal name?",
        update() {
            this.character.name.trim();
            this.$emit('update');
        },
    },
});
</script>
