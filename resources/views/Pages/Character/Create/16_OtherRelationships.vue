<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-input v-model="relationship.description" label="Relationships" @blur="update" autogrow />
                </q-card-section>
                <q-card-section>
                    <q-select
                        label="Item"
                        v-model="relationship.item"
                        :options="models.getItemsOfRarityOrBelow(7)"
                        option-value="key"
                        option-label="name"
                        @update:model-value="update"
                    />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { OtherRelationship } from '@/ts/Data/OtherRelationship';
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
    },
    setup(props) {
        const relationship = ref<OtherRelationshipsData>({
            description: '',
        });

        if (props.character.otherRelationships) {
            if (props.character.otherRelationships.description) {
                relationship.value.description = props.character.otherRelationships.description;
            }

            if (props.character.otherRelationships.item) {
                relationship.value.item = props.character.otherRelationships.item;
            }
        }

        return { relationship };
    },
    methods: {
        valid() {
            return this.character.otherRelationships !== null;
        },
        getTitle: () => "16. What are your character's preexisting relationships with other clans, families, organizations, and traditions?",
        update() {
            if (!this.relationship.item) {
                return;
            }

            this.character.otherRelationships = new OtherRelationship(this.relationship);
            this.$emit('update');
        },
    },
});
</script>
