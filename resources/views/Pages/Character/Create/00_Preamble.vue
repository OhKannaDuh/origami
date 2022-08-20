<template>
    <div class="row q-pa-xs">
        <div class="col-12">
            <q-card class="no-border-radius">
                <q-card-section>
                    The Legend of the Five rings character creation process follows a structure of 20 questions. These questions will be used to determine your
                    characters attributes, personality and gear.
                </q-card-section>
                <q-card-section>
                    <template v-if="$q.screen.lt.sm">
                        At the bottom of the screen are a set of buttons, a left arrow, a right arrow and an eye. The arrows will take you to the previous or
                        next steps. The eye will open a panel to view your characters current stats.
                    </template>
                    <template v-else> At the bottom of the screen is a set of buttons that will allow you to move between steps. </template>
                </q-card-section>
                <q-card-section> Click the right arrow to proceed. </q-card-section>
            </q-card>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    setup() {},
    methods: {
        valid: () => true,
        getTitle: () => '',
    },
});
</script>
