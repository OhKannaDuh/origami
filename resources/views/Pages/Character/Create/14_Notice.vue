<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-input label="Description" v-model="character.firstNotice" @blur="update" autogrow />
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
        getTitle: () => '14. What do people notice first upon encountering your character?',
        update() {
            this.$emit('update');
        },
    },
});
</script>
