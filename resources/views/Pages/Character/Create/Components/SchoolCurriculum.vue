<template>
    <q-dialog ref="dialogRef" @hide="onDialogHide" maximized>
        <q-card class="no-border-radius fill-width fill-height">
            <q-card-section>{{ school.name }} - Curriculum </q-card-section>
            <q-card-section v-for="(items, rank) in school.curriculum" :key="rank">
                <q-list dense bordered padding>
                    <q-item>
                        <q-item-label header v-html="`Rank ${rank}`" />
                    </q-item>
                    <q-item v-for="(item, index) in items" :key="index">
                        <template v-if="item.type === 'skill'">
                            <span v-html="title(item.skill_key)" />
                            <q-space />
                            <span>Skill</span>
                        </template>
                        <template v-else-if="item.type === 'skill-group'">
                            <span v-html="title(item.skill_group_key)" />
                            <q-space />
                            <span>Skill</span>
                        </template>
                        <template v-else-if="item.type === 'technique-type'">
                            <span v-html="techniqueType(item.technique_type_key).name" />
                            <q-space />
                            <span>Technique Group</span>
                        </template>
                        <template v-else-if="item.type === 'technique'">
                            <span v-html="technique(item.technique_key).name" />
                            <q-space />
                            <span>Technique</span>
                        </template>
                        <template v-else>
                            {{ item }}
                        </template>
                    </q-item>
                </q-list>
            </q-card-section>

            <q-space />
            <q-card-actions class="q-pa-none row fill-width">
                <q-btn class="col-12 q-ma-none no-border-radius" label="Back" color="secondary" flat @click="hide" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script lang="ts">
import { CharacterCreationModels } from '@/ts/Data/CharacterCreationModels';
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
    setup() {
        const { dialogRef, onDialogHide, onDialogOK, onDialogCancel } = useDialogPluginComponent();

        return {
            dialogRef,
            onDialogHide,
            onDialogOK,
            onDialogCancel,
        };
    },
    methods: {
        title(key: string): string {
            return key.charAt(0).toUpperCase() + key.substr(1).toLowerCase();
        },
        technique(key: string): App.Models.Character.Technique {
            return this.models.getTechnique(key);
        },
        techniqueType(key: string): App.Models.Core.TechniqueType {
            return this.models.getTechniqueType(key);
        },
    },
});
</script>
