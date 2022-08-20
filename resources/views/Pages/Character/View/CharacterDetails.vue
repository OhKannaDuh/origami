<template>
    <q-card class="no-border-radius fill-height">
        <q-card-section class="row">
            <q-avatar>
                <img :src="character.avatar" />
            </q-avatar>
            <div class="column">
                <p class="q-pl-sm q-ma-none text-body2" v-text="character.name" />
                <p class="q-pl-sm q-ma-none text-caption" v-text="`${character.clan.name} - ${character.family.name}`" />
                <p class="q-pl-sm q-ma-none text-caption" v-text="`${character.school.name} (${character.school_rank})`" />
            </div>
        </q-card-section>
    </q-card>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { defineComponent, PropType } from 'vue';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
    },
});
</script>

<style lang="scss" scoped>
.q-avatar {
    margin: 6px 6px 0px;
}
</style>
