<template>
    <div class="row column justify-center">
        <q-card class="no-border-radius">
            <q-card-section>
                <q-input autogrow v-model="character.personality.lord" label="Lord" filled disable square dense class="q-mb-sm" />
                <q-input autogrow v-model="character.personality.giri" label="Giri" filled disable square dense class="q-mb-sm" />
                <q-input autogrow v-model="character.personality.ninjo" label="Ninjo" filled disable square dense class="q-mb-sm" />
                <q-input autogrow v-model="character.personality.first_notice" label="Description" filled disable square dense class="q-mb-sm" />
                <q-input autogrow v-model="character.personality.stress" label="Stress" filled disable square dense class="q-mb-sm" />
                <q-input autogrow v-model="character.personality.death" label="Death" filled disable square dense class="q-mb-sm" />
                <!-- Relationships -->
                <q-input
                    autogrow
                    v-model="character.personality.relationships.mentor"
                    label="Mentor Relationship"
                    filled
                    disable
                    square
                    dense
                    class="q-mb-sm"
                />
                <q-input
                    autogrow
                    v-model="character.personality.relationships.parent"
                    label="Parent Relationship"
                    filled
                    disable
                    square
                    dense
                    class="q-mb-sm"
                />
                <q-input autogrow v-model="character.personality.relationships.other" label="Other Relationship" filled disable square dense class="q-mb-sm" />
            </q-card-section>
        </q-card>
    </div>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },
});
</script>
