<template>
    <q-layout view="hHh lpr lfr">
        <q-header elevated class="bg-primary text-white">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />

                <q-toolbar-title class="cursor-pointer show-overflow">
                    <Link :href="route('index.show')" as="span">
                        <q-avatar>
                            <q-icon>
                                <span class="l5r-icon opportunity icon-3x" />
                            </q-icon>
                        </q-avatar>
                        <span class="title q-pl-xs">Origami</span>
                    </Link>
                </q-toolbar-title>
                <q-space />
                <template v-if="user">
                    <div class="cursor-pointer">
                        <q-avatar class="q-mr-sm">
                            <img :src="user.avatar" />
                        </q-avatar>
                        <span v-text="user.name" />
                        <q-menu class="no-border-radius">
                            <q-list style="min-width: 150px">
                                <Link :href="route('character.index.show')" as="span">
                                    <q-item clickable v-close-popup>
                                        <q-item-section>Characters</q-item-section>
                                    </q-item>
                                </Link>
                            </q-list>
                            <q-list style="min-width: 150px">
                                <Link :href="route('campaign.index.show')" as="span">
                                    <q-item clickable v-close-popup>
                                        <q-item-section>Campaigns</q-item-section>
                                    </q-item>
                                </Link>
                            </q-list>
                            <q-list style="min-width: 150px">
                                <q-item clickable v-close-popup @click="logout">
                                    <q-item-section>Log Out</q-item-section>
                                </q-item>
                            </q-list>
                        </q-menu>
                    </div>
                </template>
                <template v-else>
                    <Link :href="route('auth.login.show')">
                        <q-btn label="Login" flat color="accent" class="no-border-radius" />
                    </Link>
                    <Link :href="route('auth.register.show')">
                        <q-btn label="Register" flat color="secondary" class="no-border-radius" />
                    </Link>
                </template>
            </q-toolbar>
        </q-header>

        <navigation :drawer="leftDrawerOpen" />

        <q-page-container class="flex justify-center">
            <slot name="prebody" />
            <q-page style="max-width: 1280px; width: 100%">
                <div class="q-px-xs q-pt-xs" v-if="$page.props.flash.message && banner">
                    <q-banner class="bg-primary text-white" desnse>
                        {{ $page.props.flash.message }}
                        <template v-slot:action>
                            <q-btn flat color="white" label="Dismiss" class="no-border-radius" @click="banner = false" />
                        </template>
                    </q-banner>
                </div>
                <slot />
            </q-page>
        </q-page-container>
    </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useQuasar } from 'quasar';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import Navigation from '@/views/components/Navigation.vue';

export default defineComponent({
    components: { Link, Navigation },
    setup() {
        const leftDrawerOpen = ref(false);

        useQuasar().dark.set(true);

        const banner = ref<boolean>(true);

        return {
            leftDrawerOpen,
            banner,
            toggleLeftDrawer() {
                leftDrawerOpen.value = !leftDrawerOpen.value;
            },
        };
    },

    methods: {
        logout() {
            Inertia.post(this.route('auth.logout.logout'));
        },
    },

    computed: {
        user() {
            return this.$page.props?.auth?.user ?? null;
        },
    },
});
</script>

<style lang="scss" scoped>
.show-overflow {
    overflow: visible;
}
.title {
    position: relative;
    top: 2px;
}
</style>
