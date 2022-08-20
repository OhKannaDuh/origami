<template>
    <div class="row">
        <div class="col-12 q-px-xs q-pb-xs">
            <q-card class="no-border-radius">
                <q-card-section> Select a School, skills, techniques and starting outfit below. </q-card-section>
            </q-card>
        </div>
    </div>

    <q-expansion-item v-if="character.clan" :label="`${character.clan.name} Schools`" v-model="open">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 q-px-xs q-pb-xs" v-for="school in clanSchools" :key="school.key">
            <school-card :school="school" :character="character" :models="models" @update="update" />
        </div>
    </q-expansion-item>

    <q-expansion-item label="Other Schools">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 q-px-xs q-pb-xs" v-for="school in otherSchools" :key="school.key">
            <school-card :school="school" :character="character" :models="models" @update="update" />
        </div>
    </q-expansion-item>
</template>

<script lang="ts">
import SchoolCard from './Components/SchoolCard.vue';
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { School } from '@/ts/Data/School';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    emits: ['update'],
    components: { SchoolCard },
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
        const clanSchools = ref<App.Models.Character.School[]>([]);
        const otherSchools = ref<App.Models.Character.School[]>([]);

        let clan: App.Models.Character.Clan | null = props.character.clan;
        for (const school of props.models.schools) {
            if (school.family?.clan?.key === clan?.key) {
                clanSchools.value.push(school);
            } else {
                otherSchools.value.push(school);
            }
        }

        const open = ref<boolean>(true);

        return {
            clanSchools,
            otherSchools,
            open,
        };
    },
    methods: {
        valid() {
            return this.character.school !== null;
        },
        getTitle: () => "03. What is your character's School, and what roles does that school fall into?",
        update(
            school: App.Models.Character.School,
            skills: App.Models.Core.Skill[],
            techniques: { [key: string]: App.Models.Character.Technique[] },
            outfit: ChosenStartingOutfit
        ) {
            this.character.school = new School(school, this.models, skills, techniques, outfit);
            this.$emit('update');
        },
    },
});
</script>
