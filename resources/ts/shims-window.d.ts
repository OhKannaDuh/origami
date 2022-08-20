import { App } from 'vue';
import { Config, RouteParam, RouteParamsWithQueryOverload, Router } from 'ziggy-js';

declare global {
    interface Window {
        vue: App<Element>;
    }

    function route(): Router;
    function route(name: string, params?: RouteParamsWithQueryOverload | RouteParam, absolute?: boolean, customZiggy?: Config): string;
}
