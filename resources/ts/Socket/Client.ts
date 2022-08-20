import SocketClient from 'pusher-js';
import { Channel } from 'pusher-js';

export class Client {
    protected client: SocketClient;

    public constructor() {
        this.client = new SocketClient(import.meta.env.VITE_WS_APP_KEY, {
            wsHost: import.meta.env.VITE_WS_CLIENT_HOST,
            wsPort: import.meta.env.VITE_WS_CLIENT_PORT,
            wssPort: import.meta.env.VITE_WS_CLIENT_PORT,
            forceTLS: import.meta.env.VITE_WS_TLS === 'true',
            authEndpoint: '/broadcasting/auth',
            disableStats: true,
            enabledTransports: ['ws', 'wss'],
        });
    }

    public subscribe(channel: string): Channel {
        return this.client.subscribe(channel);
    }
}
