<template>
  <school-dialog
    :school='school'
    :models='models'
    :ref="el => dialog = el"
    @update="update"
  />
  <q-card
    class="no-border-radius fill-height cursor-pointer"
    :class="{ highlight: hasChosenSchool(school) }"
    @click="dialog.show"
  >
    <!-- <q-img class="col" src="https://cdn.quasar.dev/img/parallax2.jpg" /> -->
    <q-card-section>
      <div class="text-h5 q-mb-none" v-text="school.name" />
      <div class="text-caption q-mb-xs" v-text="schoolTypes" />
      <p class="q-ma-none">
        <span class="text-weight-bold"> Rings</span>: +1
        {{ school.ring_one.name }}, +1
        {{ school.ring_two.name }}
      </p>

      <p class="q-ma-none">
        <span class="text-weight-bold">Starting Skills (Choose {{ getNumberAsWord(school.starting_skill_amount) }})</span>:
        <span v-for="key in school.starting_skills" :key="key" class="list-separator">
          {{ models.getSkill(key).name }}
        </span>
      </p>

      <p class="q-ma-none">
        <span class="text-weight-bold"> Honor</span>: {{ school.honor }}
      </p>

      <p class="q-ma-none">
        <span class="text-weight-bold">Techniques Available</span>:
        <span
          v-for="type in school.available_technique_types"
          :key="type.key"
          class="list-separator"
        >
          <span
            >{{ type.name }}&nbsp;(<i
              class="l5r-icon"
              :class="type.key"
            />)</span
          >
        </span>
      </p>

      <p class="q-ma-none">
        <span class="text-weight-bold">Starting Techniques</span>:

        <ul class="q-pl-lg q-ma-none">
          <li
          v-for="(group, key) in startingTechniques"
          :key="key"
        >
          <span class="text-weight-bold">
            {{ group.name
            }}<span v-if="group.isChoice()">
              (Choose {{ getNumberAsWord(group.amount) }})</span
            >:
          </span>
          <span
            v-for="technique in group.getTechniques()"
            :key="technique.key"
            class="list-separator"
          >
            {{ technique.name }}
          </span>
        </li>
        </ul>
      </p>

      <p class="q-ma-none">
        <span class="text-weight-bold">Starting Outfit</span>:
        <span v-for='outfit, key in startingOutfit' :key='key' class="list-separator">
          {{outfit.toText()}}
        </span>
      </p>
    </q-card-section>
    <q-card-actions class="q-pa-none row">
        <q-btn class="col-12 no-border-radius" label="Select" color="secondary" flat />
    </q-card-actions>
  </q-card>
</template>

<script lang="ts">
import SchoolDialog from './SchoolDialog.vue';
import { Character as CharacterData } from '@/ts/Data/Character';
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { QDialog } from 'quasar';
import { StartingOutfit } from '@/ts/Data/StartingOutfit';
import { StartingTechnique } from '@/ts/Data/StartingTechnique';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    components: { SchoolDialog },
    emits: ['update'],
    props: {
        school: {
            type: Object as PropType<App.Models.Character.School>,
            required: true,
        },
        character: {
            type: Object as PropType<CharacterData>,
            required: true,
        },
        models: {
            type: Object as PropType<CharacterCreationModels>,
            required: true,
        },
    },
    setup() {
        const dialog = ref(QDialog);

        return { dialog };
    },
    methods: {
        update(
            school: App.Models.Character.School,
            skills: App.Models.Core.Skill[],
            techniques: { [key: string]: App.Models.Character.Technique[] },
            outfit: ChosenStartingOutfit,
        ) {
            this.$emit('update', school, skills, techniques, outfit);
        },
        hasChosenSchool(school: App.Models.Character.School): boolean {
            return this.character.school?.key === school.key;
        },
        getStartingTechnique(data: StartingTechniqueData): StartingTechnique {
            return new StartingTechnique(data, this.models);
        },
    },
    computed: {
        schoolTypes(): string {
            let types: string[] = [];
            this.school.school_types?.forEach((type: App.Models.Core.SchoolType) => types.push(type.name));

            return `[${types.join(', ')}]`;
        },

        startingTechniques(): { [key: string]: StartingTechnique } {
            let startingTechniques: { [key: string]: StartingTechnique } = {};
            for (const [key, data] of Object.entries(this.school.starting_techniques)) {
                startingTechniques[key] = new StartingTechnique(data, this.models);
            }

            return startingTechniques;
        },

        startingOutfit(): StartingOutfit[] {
          let items: StartingOutfit[] = [];
          for (const data of this.school.starting_outfit) {
            items.push(new StartingOutfit(data, this.models));
          }

          return items;
        }
    },
});
</script>
