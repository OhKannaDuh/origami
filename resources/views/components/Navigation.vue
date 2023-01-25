<template>
    <q-drawer v-model="drawer" side="left" overlay elevated>
        <q-scroll-area class="fit">
            <q-list>
                <Link v-for="item in items" :key="item.route" :href="route(item.route)" as="span">
                    <q-item clickable>
                        <q-item-section v-text="item.label" />
                    </q-item>
                </Link>
                <q-separator />
                <Link v-for="item in options" :key="item.route" :href="route(item.route)" as="span">
                    <q-item clickable>
                        <q-item-section v-text="item.label" />
                    </q-item>
                </Link>

                <q-separator />

                <q-item v-if="$page.props.auth.user" clickable v-close-popup @click="logout">
                    <q-item-section>Log Out</q-item-section>
                </q-item>

                <template v-else>
                    <Link :href="route('auth.login.show')" as="span">
                        <q-item clickable>
                            <q-item-section v-text="`Login`" />
                        </q-item>
                    </Link>
                    <Link :href="route('auth.register.show')" as="span">
                        <q-item clickable>
                            <q-item-section v-text="`Register`" />
                        </q-item>
                    </Link>
                </template>
            </q-list>
        </q-scroll-area>
    </q-drawer>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default defineComponent({
    components: { Link },
    props: {
        drawer: {
            type: Boolean,
            required: true,
        },
    },
    setup() {
        const items = ref([
            {
                route: 'index.show',
                label: 'Home',
            },
            {
                route: 'character.index.show',
                label: 'Characters',
            },
            {
                route: 'campaign.index.show',
                label: 'Campaigns',
            },
        ]);

        const options = ref([
            {
                route: 'source-book.index.show',
                label: 'Source Books',
            },
            {
                route: 'clan.index.show',
                label: 'Clans',
            },
            {
                route: 'family.index.show',
                label: 'Families',
            },
            {
                route: 'school.index.show',
                label: 'Schools',
            },
            {
                route: 'advantage.index.show',
                label: 'Advantages',
            },
            {
                route: 'disadvantage.index.show',
                label: 'Disadvantages',
            },
        ]);

        return { items, options };
    },
    methods: {
        logout() {
            Inertia.post(route('auth.logout.lohout'));
        },
    },
});
</script>
