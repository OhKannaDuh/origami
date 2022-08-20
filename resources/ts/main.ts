import quasarLang from 'quasar/lang/en-GB';
import { InertiaProgress } from '@inertiajs/progress';
import { Quasar, Dialog } from 'quasar';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { importPageComponent } from '@/ts/vite/import-page-component';
import Route from '@/views/components/Route.vue';
import axios from 'axios';

import '@quasar/extras/material-icons/material-icons.css';
import '../scss/index.scss';

// axios.defaults.withCredentials = true;

createInertiaApp({
    resolve: (name) => importPageComponent(name, import.meta.glob('../views/Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        let vue = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Quasar, {
                plugins: {
                    Dialog,
                },
                lang: quasarLang,
            });

        vue.config.globalProperties.getNumberAsWord = (subject: number): string => {
            return ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'][subject] ?? 'none';
        };

        vue.config.globalProperties.route = window.route;

        vue.component('route', Route);

        vue.mount(el);
    },
});

InertiaProgress.init();
