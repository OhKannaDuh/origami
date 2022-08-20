<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-input v-model="character.lord" label="Your Lord" @blur="update" autogrow />
                    <q-input v-model="character.giri" label="Your Giri" @blur="update" autogrow />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    methods: {
        valid: () => true,
        getTitle: () => "05. Who is your Lord and what is your character's duty to them?",
        update() {
            this.$emit('update');
        },
    },
});
</script>
