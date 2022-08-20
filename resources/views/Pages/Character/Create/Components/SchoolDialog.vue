<template>
    <q-dialog ref="dialogRef" @hide="onDialogHide" maximized>
        <q-card class="no-border-radius fill-width">
            <q-card-section>{{ school.name }} </q-card-section>
            <q-card-section>
                <q-select
                    filled
                    counter
                    multiple
                    :label="`Starting Skills (Choose ${getNumberAsWord(school.starting_skill_amount)})`"
                    v-model="chosenStartingSkills"
                    :options="startingSkillChoices"
                    option-value="key"
                    option-label="name"
                    :max-values="school.starting_skill_amount"
                    @update:model-value="validated"
                />

                <q-select
                    v-for="(techniques, key) in startingTechniqueChoices"
                    :key="key"
                    filled
                    counter
                    multiple
                    :label="`${techniques.name} (Choose ${getNumberAsWord(techniques.amount)})`"
                    v-model="chosenStartingTechniques[key]"
                    :options="techniques.getTechniques()"
                    option-value="key"
                    option-label="name"
                    :max-values="techniques.amount"
                    @update:model-value="validated"
                />

                <q-select
                    v-for="(outfit, index) in startingOutfitChoices"
                    :key="index"
                    filled
                    counter
                    multiple
                    :label="outfit.toText()"
                    v-model="chosenStartingOutfit[index]"
                    :options="outfit.getItems()"
                    option-value="key"
                    option-label="name"
                    :max-values="1"
                    @update:model-value="validated"
                />

                <q-select
                    v-if="hasTravellingPack()"
                    filled
                    counter
                    multiple
                    label="Travelling Pack Items"
                    v-model="chosenStartingOutfit.traveling_pack"
                    :options="travellingPackChoices"
                    option-value="key"
                    option-label="name"
                    :max-values="3"
                    @update:model-value="validated"
                />
            </q-card-section>

            <q-card-actions class="q-pa-none">
                <div class="row fill-width">
                    <q-btn label="Cancel" @click="hide" color="negative" flat class="no-border-radius col-6" />
                    <q-btn label="Select" @click="update" :color="valid ? 'positive' : 'negative'" flat class="no-border-radius col-6" :disable="!valid" />
                </div>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script lang="ts">
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
import { StartingOutfit } from '@/ts/Data/StartingOutfit';
import { StartingTechnique } from '@/ts/Data/StartingTechnique';
import { defineComponent, PropType, ref } from 'vue';
import { useDialogPluginComponent } from 'quasar';

export default defineComponent({
    emits: ['update'],
    props: {
        school: {
            type: Object as PropType<App.Models.Character.School>,
            required: true,
        },
        models: {
            type: Object as PropType<CharacterCreationModels>,
            required: true,
        },
    },
    setup(props) {
        const { dialogRef, onDialogHide, onDialogOK, onDialogCancel } = useDialogPluginComponent();

        const startingSkillChoices = ref<App.Models.Core.Skill[]>([]);
        const chosenStartingSkills = ref<App.Models.Core.Skill[]>([]);
        for (const key of props.school.starting_skills) {
            startingSkillChoices.value.push(props.models.getSkill(key));
        }

        const startingTechniqueChoices = ref<{ [key: string]: StartingTechnique }>({});
        const chosenStartingTechniques = ref<{ [key: string]: App.Models.Character.Technique[] }>({});
        for (const [key, data] of Object.entries(props.school.starting_techniques)) {
            if (data.type !== 'choice') {
                continue;
            }

            chosenStartingTechniques.value[key] = [];
            startingTechniqueChoices.value[key] = new StartingTechnique(data, props.models);
        }

        const startingOutfitChoices = ref<{ [key: string]: StartingOutfit }>({});
        const chosenStartingOutfit = ref<ChosenStartingOutfit>({
            traveling_pack: [],
        });
        props.school.starting_outfit.forEach((data: StartingOutfitData, index: number) => {
            if (data.type !== 'choice') {
                return;
            }

            startingOutfitChoices.value[index] = new StartingOutfit(data, props.models);
        });

        const travellingPackChoices = ref<App.Models.Character.Item[]>([]);
        props.models.getItemsOfRarityOrBelow(4).forEach((item: App.Models.Character.Item) => travellingPackChoices.value.push(item));

        const valid = ref<boolean>(false);

        return {
            dialogRef,
            onDialogHide,
            onDialogOK,
            onDialogCancel,
            startingSkillChoices,
            chosenStartingSkills,
            startingTechniqueChoices,
            chosenStartingTechniques,
            startingOutfitChoices,
            chosenStartingOutfit,
            travellingPackChoices,
            valid,
        };
    },
    methods: {
        validated() {
            this.valid = this.isValid();
        },
        isValid() {
            if (this.chosenStartingSkills.length < this.school.starting_skill_amount) {
                return false;
            }

            for (const [key, techniques] of Object.entries(this.startingTechniqueChoices)) {
                if (this.chosenStartingTechniques[key].length < (techniques.amount ?? 0)) {
                    return false;
                }
            }

            if (Object.entries(this.chosenStartingOutfit).length < Object.entries(this.startingOutfitChoices).length) {
                return false;
            }

            if (this.hasTravellingPack() && this.chosenStartingOutfit.traveling_pack.length < 3) {
                return false;
            }

            return true;
        },
        update() {
            if (!this.isValid()) {
                return;
            }

            let techniques: { [key: string]: App.Models.Character.Technique[] | App.Models.Character.Technique } = {};
            for (const [key, data] of Object.entries(this.chosenStartingTechniques)) {
                let datum = data;
                if (!(data instanceof Array)) {
                    datum = [data];
                }

                techniques[key] = datum;
            }

            this.$emit('update', this.school, this.chosenStartingSkills, techniques, this.chosenStartingOutfit);

            this.hide();
        },
        hasTravellingPack(): boolean {
            for (const outfit of this.school.starting_outfit) {
                if (outfit.type === 'traveling_pack') {
                    return true;
                }
            }

            return false;
        },
    },
});
</script>
