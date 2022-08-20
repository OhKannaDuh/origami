<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section>
                    <q-input v-model="relationship.description" label="Your Mentor" @blur="update" autogrow />
                </q-card-section>
            </q-card>
        </div>

        <div class="col-12 q-px-xs q-pb-xs">
            <div class="text-h6">Choose one of the following:</div>
        </div>

        <div class="col-12 col-sm-6 q-px-xs q-pb-xs">
            <q-card class="no-border-radius fill-height" :class="{ highlight: character.mentor && character.mentor.advantage }">
                <q-card-section> One advantage related to your character's mentor and their relationshp.</q-card-section>
                <q-card-section>
                    <q-select
                        label="Advantage"
                        v-model="relationship.advantage"
                        :options="models.getAdvantages()"
                        option-value="key"
                        option-label="name"
                        @update:model-value="advantage"
                    />
                </q-card-section>
            </q-card>
        </div>

        <div class="col-12 col-sm-6 q-px-xs q-pb-xs">
            <q-card class="no-border-radius fill-height" :class="{ highlight: character.mentor && character.mentor.disadvantage }">
                <q-card-section> One disadvantage and one rank in a skill related to your character's mentor and their relationshp.</q-card-section>

                <q-card-section>
                    <q-select
                        label="Disadvantage"
                        v-model="relationship.disadvantage"
                        :options="models.getDisadvantages()"
                        option-value="key"
                        option-label="name"
                        @update:model-value="disadvantage"
                    />
                    <q-select
                        label="Skill"
                        v-model="relationship.skill"
                        :options="models.skills"
                        option-value="key"
                        option-label="name"
                        @update:model-value="disadvantage"
                    />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { MentorRelationship } from '@/ts/Data/MentorRelationship';
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
        const relationship = ref<MentorRelationshipData>({
            description: '',
        });

        if (props.character.mentor) {
            if (props.character.mentor.description) {
                relationship.value.description = props.character.mentor.description;
            }
            if (props.character.mentor.skill) {
                relationship.value.skill = props.character.mentor.skill;
            }

            if (props.character.mentor.disadvantage) {
                relationship.value.disadvantage = props.character.mentor.disadvantage;
            }

            if (props.character.mentor.advantage) {
                relationship.value.advantage = props.character.mentor.advantage;
            }
        }

        return { relationship };
    },
    methods: {
        valid() {
            return this.character.mentor !== null;
        },
        getTitle: () => '13. Who has your character learned the most from during their life?',
        update() {
            this.character.mentor = new MentorRelationship(this.relationship);
            this.$emit('update');
        },
        advantage() {
            this.relationship.disadvantage = null;
            this.relationship.skill = null;

            this.update();
        },
        disadvantage() {
            this.relationship.advantage = null;
            if (!this.relationship.disadvantage || !this.relationship.skill) {
                return;
            }

            this.update();
        },
    },
});
</script>
