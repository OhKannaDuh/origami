<template>
    <div class='no-height'>
        <q-btn v-if='mobile' round :icon="expand ? 'expand_less' : 'expand_more'" color="accent" class='expand-button' @click='toggle'/>
    </div>
    <q-card class="fill-height no-border-radius">
        <q-card-section class="">
            <div class="row fill-height">
                <div class="row column col-12 justify-center" :class="{ 'q-pb-md': $q.screen.lt.lg }">
                    <div class="row justify-around">
                        <div v-for="(rank, key) in character.stats.rings" class="col-2" :key="key">
                            <p class="no-margin text-center q-pa-sm">
                                <i class="l5r-icon icon-2x" :class="classes(key)" />
                            </p>
                            <p class="no-margin text-center no-height">
                                <i class="ring-value" :class="`background-${key}`" v-html="rank" />
                            </p>
                            <q-tooltip :class="`background-${key}`" v-text="title(key)" self="top middle" />
                        </div>
                    </div>
                </div>
            </div>
        </q-card-section>
        <q-card-section>
            <div class="row fill-height">
                <div class="row column col-12 justify-center">
                    <div class="row justify-around">
                        <div class="col-4">
                            <p class="no-margin text-center">
                                <i class="l5r-icon icon-4x success social-ring-1"/>
                                <p class="social-value no-height q-ma-none" v-text="character.stats.social.honor"/>
                                <p>Honor</p>
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="no-margin text-center">
                                <i class="l5r-icon icon-4x success" />
                                <p class="social-value no-height q-ma-none" v-text="character.stats.social.glory"/>
                                <p>Glory</p>
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="no-margin text-center">
                                <i class="l5r-icon icon-4x success social-ring-3" />
                                <p class="social-value no-height q-ma-none" v-text="character.stats.social.status"/>
                                <p>Status</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </q-card-section>
    </q-card>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { defineComponent, PropType, ref } from 'vue';

export default defineComponent({
    emits: ['toggle'],

    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        expand: {
            type: Boolean,
            required: true,
        },
    },

    methods: {
        classes(key: string): string {
            return `${key} color-${key}`;
        },
        title(key: string): string {
            return key.charAt(0).toUpperCase() + key.substr(1).toLowerCase();
        },
        toggle() {
            this.$emit('toggle');
        },
    },

    computed: {
        endurance() {
            return (this.character.stats.rings.earth + this.character.stats.rings.fire) * 2;
        },
        composure() {
            return (this.character.stats.rings.earth + this.character.stats.rings.water) * 2;
        },
        focus() {
            return this.character.stats.rings.air + this.character.stats.rings.fire;
        },
        vigilance() {
            return Math.ceil((this.character.stats.rings.air + this.character.stats.rings.water) / 2);
        },
        mobile(): boolean {
            return this.$q.screen.lt.sm;
        },
    },
});
</script>

<style lang="scss" scoped>
.ring-value {
    display: block;
    border-radius: 50%;
    height: 20px;
    width: 20px;
    position: relative;
    left: 50%;
    bottom: 20px;
}

.social-value {
    display: block;
    border-radius: 50%;
    position: relative;
    bottom: 40px;
}

.no-height {
    height: 0;
}

.social-ring-1 {
    transform: rotate(-135deg);
    position: relative;
    bottom: 5px;
    left: 3px;
}

.social-ring-3 {
    transform: rotate(90deg);
    position: relative;
    bottom: 2px;
    right: 4px;
}

.expand-button {
    position: relative;
    bottom: 21px;
    left: 9px;
    z-index: 1;
}
</style>
