<template>
    <div class="row">
        <div class="col-12 col-sm-9 col-md-10">
            <div class="text-h6 title-case text-center" :class="{ 'q-pa-xs': title }" v-text="title" />
            <step-0 v-if="step === 0" :ref="(el) => (current = el)" />
            <step-1 v-if="step === 1" :ref="(el) => (current = el)" :clans="models.clans" :character="character" @update="update" />
            <step-2 v-if="step === 2" :ref="(el) => (current = el)" :families="models.families" :character="character" @update="update" />
            <step-3 v-if="step === 3" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-4 v-if="step === 4" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-5 v-if="step === 5" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-6 v-if="step === 6" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-7 v-if="step === 7" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-8 v-if="step === 8" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-9 v-if="step === 9" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-10 v-if="step === 10" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-11 v-if="step === 11" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-12 v-if="step === 12" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-13 v-if="step === 13" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-14 v-if="step === 14" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-15 v-if="step === 15" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-16 v-if="step === 16" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-17 v-if="step === 17" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-18 v-if="step === 18" :ref="(el) => (current = el)" :character="character" :models="models" @update="update" />
            <step-19 v-if="step === 19" :ref="(el) => (current = el)" :character="character" @update="update" />
            <step-20 v-if="step === 20" :ref="(el) => (current = el)" :character="character" @update="update" />
        </div>

        <!-- Side bar stats -->
        <div class="col-3 col-md-2 q-pa-xs" v-if="!$q.screen.lt.sm">
            <q-card class="no-border-radius">
                <character-details :character="character" />
                <rings :rings="character.rings" />
                <advantages-and-disadvantages :character="character" />
                <social-stats :character="character" />
                <skills :character="character" />
                <techniques :techniques="character.techniques" />
                <items :items="character.items" />
            </q-card>
        </div>

        <q-drawer v-else v-model="drawer" side="right" overlay elevated>
            <q-scroll-area class="fit">
                <character-details :character="character" />
                <rings :rings="character.rings" />
                <advantages-and-disadvantages :character="character" />
                <social-stats :character="character" />
                <skills :character="character" />
                <techniques :techniques="character.techniques" />
                <items :items="character.items" />
            </q-scroll-area>
        </q-drawer>
    </div>

    <div class="row">
        <div class="bottom-padding col-12" />
    </div>

    <!-- FABs -->
    <q-page-sticky position="bottom-left" :offset="[18, 18]">
        <q-btn round icon="chevron_left" @click="previous" :disable="step <= 0" color="accent" />
    </q-page-sticky>
    <q-page-sticky position="bottom" :offset="[0, 18]" v-if="$q.screen.lt.sm">
        <q-btn round icon="visibility" @click="drawer = !drawer" color="accent" />
    </q-page-sticky>
    <q-page-sticky position="bottom-right" :offset="[18, 18]">
        <q-btn round icon="chevron_right" @click="next" :disable="!validated" color="accent" />
    </q-page-sticky>
</template>

<script lang="ts">
import Layout from '@/views/layouts/default.vue';
import axios from 'axios';
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { defineComponent, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

import Rings from './Values/Rings.vue';
import Skills from './Values/Skills.vue';
import SocialStats from './Values/SocialStats.vue';
import CharacterDetails from './Values/CharacterDetails.vue';
import Techniques from './Values/Techniques.vue';
import Items from './Values/Items.vue';
import AdvantagesAndDisadvantages from './Values/AdvantagesAndDisadvantages.vue';

let values = {
    Rings,
    Skills,
    SocialStats,
    CharacterDetails,
    Techniques,
    Items,
    AdvantagesAndDisadvantages,
};

import Step0 from './00_Preamble.vue';
import Step1 from './01_Clan.vue';
import Step2 from './02_Family.vue';
import Step3 from './03_School.vue';
import Step4 from './04_StandOut.vue';
import Step5 from './05_LordAndGiri.vue';
import Step6 from './06_Ninjo.vue';
import Step7 from './07_ClanRelationship.vue';
import Step8 from './08_Bushido.vue';
import Step9 from './09_Distinction.vue';
import Step10 from './10_Adversity.vue';
import Step11 from './11_Passion.vue';
import Step12 from './12_Anxiety.vue';
import Step13 from './13_Relationship.vue';
import Step14 from './14_Notice.vue';
import Step15 from './15_Stress.vue';
import Step16 from './16_OtherRelationships.vue';
import Step17 from './17_Parents.vue';
import Step18 from './18_Heritage.vue';
import Step19 from './19_Name.vue';
import Step20 from './20_Death.vue';

let steps = {
    Step0,
    Step1,
    Step2,
    Step3,
    Step4,
    Step5,
    Step6,
    Step7,
    Step8,
    Step9,
    Step10,
    Step11,
    Step12,
    Step13,
    Step14,
    Step15,
    Step16,
    Step17,
    Step18,
    Step19,
    Step20,
};

export default defineComponent({
    emits: ['update'],
    components: { Layout, ...values, ...steps },
    async setup() {
        const step = ref<number>(-1);
        const current = ref<Step | null>(null);
        const validated = ref<boolean>(true);
        const models = ref<CharacterCreationModels>();
        const character = ref<CharacterData>();
        const drawer = ref<boolean>(false);
        const title = ref<string>('');

        await axios
            .get(route('api.character.data.all'))
            .then((response) => {
                models.value = new CharacterCreationModels(response.data);
                character.value = new CharacterData(models.value);
                step.value++;
            })
            .catch((error) => console.error(error));

        return {
            step,
            current,
            validated,
            models,
            character,
            drawer,
            title,
        };
    },
    methods: {
        next() {
            this.step++;
        },
        previous() {
            this.step--;
        },
        update(reverse: boolean = false) {
            this.validated = this.current?.valid() ?? false;
            this.title = this.current?.getTitle() ?? '';

            this.character?.recalculate();

            if (reverse) {
                this.$nextTick(this.update);
            }

            if (this.step > 20 && this.character) {
                this.submit(this.character);
            }
        },
        submit(character: CharacterData) {
            Inertia.post(route('character.create.store'), { character: character, user: this.$page.props.auth.user });
        },
    },

    watch: {
        step(value: number, previous: number) {
            this.$nextTick(() => {
                this.update(previous > value);
                this.$emit('update', this.step);
            });
        },
    },
});
</script>

<style lang="scss" scoped>
.title-case {
    text-transform: uppercase;
}

.bottom-padding {
    min-height: 78px;
}
</style>
