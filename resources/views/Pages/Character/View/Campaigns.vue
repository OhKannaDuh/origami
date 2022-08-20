<template>
    <q-card class="no-border-radius fill-height">
        <q-card-section class="row">
            <q-list class="fit">
                <q-item v-for="campaign in character.campaigns" :key="campaign.uuid">
                    <q-item-section v-text="campaign.name" />
                    <q-space />
                    <q-item-section class="col-shrink">
                        <route label="Play" :route="route('character.view.campaign', { campaign: campaign.uuid, character: character.uuid })" color="accent" />
                    </q-item-section>
                    <q-item-section class="col-shrink">
                        <route label="View" :route="route('campaign.view.show', { campaign: campaign.uuid })" color="accent" />
                    </q-item-section>
                </q-item>
                <q-item v-if="character.campaigns.length <= 0">
                    <q-item-section> Looks like this character isn't in any campaigns. </q-item-section>
                </q-item>
            </q-list>
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
