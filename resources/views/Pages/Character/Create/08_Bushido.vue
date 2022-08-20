<template>
    <div class="row">
        <div class="col-12 col-sm-6 q-px-xs q-pb-xs">
            <q-card class="no-border-radius fill-height column cursor-pointer" @click="positive" :class="{ highlight: bushido.positive }">
                <q-card-section class="text-center">
                    Your character's belief in living by an orthodox interpretation of bushido is very staunch.
                </q-card-section>
                <q-card-section class="text-center col-grow column justify-center">
                    <span>+10 honor</span>
                </q-card-section>
                <q-card-actions class="q-pa-none row">
                    <q-btn class="col-12 no-border-radius" label="Select" color="secondary" flat />
                </q-card-actions>
            </q-card>
        </div>
        <div class="col-12 col-sm-6 q-px-xs q-pb-xs">
            <q-card class="no-border-radius fill-height" :class="{ highlight: !bushido.positive && bushido.skill }">
                <q-card-section class="text-center">
                    Your character You character diverges from some or all common beliefs about how a smurai should behave honorably.
                </q-card-section>
                <q-card-section class="text-center q-ma-none q-pa-none"> Gain 1 rank in one of the following skills: </q-card-section>
                <q-card-section class="text-center q-ma-none q-pa-none">
                    <span v-for="skill in skills" :key="skill.key" v-text="skill.name" class="list-separator" />
                </q-card-section>
                <q-card-section>
                    <q-select v-model="bushido.skill" :options="skills" option-value="key" option-label="name" @update:model-value="negative" />
                </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { Character as CharacterData } from '@/ts/Data/Character';
import { defineComponent, PropType, ref } from 'vue';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { Bushido } from '@/ts/Data/Bushido';

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
        const bushido = ref<BushidoData>(
            props.character.bushido ?? {
                positive: false,
            }
        );

        const skills = ref<App.Models.Core.Skill[]>([]);
        skills.value.push(props.models.getSkill('commerce'));
        skills.value.push(props.models.getSkill('labor'));
        skills.value.push(props.models.getSkill('medicine'));
        skills.value.push(props.models.getSkill('seafaring'));
        skills.value.push(props.models.getSkill('skulduggery'));
        skills.value.push(props.models.getSkill('survival'));

        return { bushido, skills };
    },
    methods: {
        valid() {
            return this.character.bushido !== null;
        },
        getTitle: () => '08. What does your character think of Bushido?',
        update() {
            this.character.bushido = new Bushido(this.bushido);
            this.$emit('update');
        },
        positive() {
            this.bushido.positive = true;
            this.bushido.skill = null;

            this.update();
        },
        negative() {
            this.bushido.positive = false;

            this.update();
        },
    },
});
</script>
