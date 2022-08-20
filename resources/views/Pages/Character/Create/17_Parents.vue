<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-input v-model="relationship.description" label="Relationships" @blur="update" autogrow />
                </q-card-section>
                <q-card-section>
                    <q-select
                        label="Skill"
                        v-model="relationship.skill"
                        :options="character.getSkillsWithoutRanks()"
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
import { ParentRelationship } from '@/ts/Data/ParentRelationship';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
    },
    setup(props) {
        const relationship = ref<ParentRelationshipData>({
            description: '',
        });

        if (props.character.parentRelationship) {
            if (props.character.parentRelationship.description) {
                relationship.value.description = props.character.parentRelationship.description;
            }

            if (props.character.parentRelationship.skill) {
                relationship.value.skill = props.character.parentRelationship.skill;
            }
        }

        return { relationship };
    },
    methods: {
        valid() {
            return this.character.parentRelationship !== null;
        },
        getTitle: () => "17. How would your character's parents describe them?",
        update() {
            if (!this.relationship.skill) {
                return;
            }

            this.character.parentRelationship = new ParentRelationship(this.relationship);
            this.$emit('update');
        },
    },
});
</script>
