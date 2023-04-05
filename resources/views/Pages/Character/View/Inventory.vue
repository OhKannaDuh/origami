<template>
    <q-card>
        <q-card-section class="row">
            <q-space />
            <div>Koku: {{ inventory.getTotalQuantity('koku') }} |&nbsp;</div>
            <div>Bu: {{ inventory.getTotalQuantity('bu') }} |&nbsp;</div>
            <div>Zeni: {{ inventory.getTotalQuantity('zeni') }}</div>
        </q-card-section>
        <q-table
            v-for="container in containers"
            :key="container.id"
            :title="container.name"
            class="q-mb-xs no-border-radius"
            :rows="container.items"
            dense
            hide-header
            hide-bottom
            :pagination="{ rowsPerPage: 10 }"
            :columns="columns"
            @row-click="
                (event, row, index) => {
                    subjectContainer = container;
                    newContainer = container;
                    subject = row;
                    closeAll();
                    drawers.item = true;
                }
            "
        />
    </q-card>

    <q-card class="q-mt-xs no-border-radius">
        <q-card-section class="row justify-between">
            <q-btn
                label="Add Items"
                class="no-border-radius"
                color="accent"
                @click="
                    () => {
                        closeAll();
                        drawers.items = true;
                    }
                "
            />
            <q-btn
                label="Manage Containers"
                class="no-border-radius"
                color="accent"
                @click="
                    () => {
                        closeAll();
                        drawers.container = true;
                    }
                "
            />
        </q-card-section>
    </q-card>

    <!-- Add items Drawer -->
    <q-drawer side="right" v-model="drawers.items" elevated overlay>
        <q-scroll-area class="fit">
            <q-list class="q-pa-sm">
                <q-item clickable @click="closeAll">
                    <q-item-section avatar>
                        <q-icon name="chevron_right" />
                    </q-item-section>
                    <q-item-section>Close</q-item-section>
                </q-item>
                <q-separator />
                <q-item>
                    <q-select v-model="subjectContainer" class="fill-width" :options="containers" option-value="key" option-label="name" />
                </q-item>
                <q-item v-for="item in repository.all()" :key="item.id" clickable @click="add(item)">
                    <q-item-section avatar>
                        <q-icon name="add" />
                    </q-item-section>
                    <q-item-section> {{ item.name }} </q-item-section>
                </q-item>
            </q-list>
        </q-scroll-area>
    </q-drawer>

    <!-- Manage container Drawer -->
    <q-drawer side="right" v-model="drawers.container" elevated overlay>
        <q-scroll-area class="fit">
            <q-list class="q-pa-sm">
                <q-item clickable @click="closeAll">
                    <q-item-section avatar>
                        <q-icon name="chevron_right" />
                    </q-item-section>
                    <q-item-section>Close</q-item-section>
                </q-item>
                <q-separator />
                <q-item v-for="container in inventory.containers" :key="container.id">
                    <q-input v-model="container.name" class="fit" @update:model-value="update" />
                    <div class="q-pa-md q-pr-none">
                        <q-btn round color="negative" flat icon="close" @click="removeContainer(container)" />
                    </div>
                </q-item>
                <q-item>
                    <q-btn label="Add New" class="no-border-radius" color="accent" @click="addNewContainer" />
                </q-item>
            </q-list>
        </q-scroll-area>
    </q-drawer>

    <!-- Manage item Drawer -->
    <q-drawer side="right" v-model="drawers.item" elevated overlay>
        <q-scroll-area class="fit">
            <q-list class="q-pa-sm">
                <q-item clickable @click="closeAll">
                    <q-item-section avatar>
                        <q-icon name="chevron_right" />
                    </q-item-section>
                    <q-item-section>Close</q-item-section>
                </q-item>
                <q-separator />
                <q-item v-if="subject !== null">
                    <div class="column fill-width">
                        <q-item-section>
                            <q-item-label>
                                {{ subject.getItem().name }}
                            </q-item-label>
                        </q-item-section>
                        <q-item-section>
                            <q-input
                                class="q-mb-sm"
                                v-model="subject.custom_name"
                                @change="parseCustomName(subject)"
                                label="Name Override"
                                @update:model-value="update"
                            />
                            <q-input class="q-mb-sm" type="number" v-model="subject.quantity" label="Quantity" @update:model-value="update" />
                            <div class="row">
                                <div class="col-12 q-pa-xs">
                                    <q-btn
                                        class="q-mb-sm no-border-radius fill-width"
                                        label="Remove"
                                        color="negative"
                                        @click="
                                            () => {
                                                subject.shouldRemove = true;
                                                closeAll();
                                                update();
                                            }
                                        "
                                    />
                                </div>
                                <div class="col-12 q-pa-xs">
                                    <q-btn class="q-mb-sm no-border-radius fill-width" label="Move" color="accent" @click="dialog = true" />
                                </div>
                            </div>
                        </q-item-section>
                    </div>
                </q-item>
            </q-list>
        </q-scroll-area>
    </q-drawer>

    <!-- Move item Dialog -->
    <q-dialog v-model="dialog">
        <q-card style="min-width: 250px">
            <q-card-section>
                <q-select v-model="newContainer" :options="containers" option-value="key" option-label="name" />
            </q-card-section>

            <q-card-section>
                <q-btn class="q-mb-sm no-border-radius fill-width" label="Move" color="accent" @click="move" :disable="newContainer === subjectContainer" />
            </q-card-section>
        </q-card>
    </q-dialog>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { InventoryItem } from '@/ts/Inventory/InventoryItem';
import { Inventory } from '@/ts/Inventory/Inventory';
import { ItemRepository } from '@/ts/Repositories/ItemRepository';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { defineComponent, PropType, ref } from 'vue';
import { v4 as uuidv4 } from 'uuid';
import { IContainer, IInventory, IInventoryItem } from '@/ts/data';

export default defineComponent({
    props: {
        character: {
            type: Object as PropType<Character>,
            required: true,
        },
        saveManager: {
            type: Object as PropType<SaveManager>,
            required: true,
        },
    },
    async setup(props) {
        const repository = new ItemRepository();
        await repository.init();

        const inventory = ref<Inventory>(Inventory.fromCharacterInventory(props.character.inventory, repository));

        const columns = ref<Object[]>([
            {
                name: 'item',
                field: (item: IInventoryItem) => item.getName(),
                align: 'left',
            },
            {
                name: 'quantity',
                field: 'quantity',
                align: 'right',
            },
        ]);

        const drawers = ref<{ [key: string]: boolean }>({
            item: false,
            items: false,
            container: false,
        });

        const dialog = ref<boolean>(false);

        const subject = ref<IInventoryItem | null>(null);
        const subjectContainer = ref<IContainer | null>(inventory.value.containers[0]);
        const newContainer = ref<IContainer | null>(null);

        return {
            columns,
            dialog,
            drawers,
            inventory,
            newContainer,
            repository,
            subject,
            subjectContainer,
        };
    },
    methods: {
        update() {
            this.saveManager.saveInventory(this.character, this.inventory);
        },
        parseCustomName(subject: IInventoryItem) {
            subject.custom_name = subject.custom_name.trim();
        },
        closeAll() {
            for (const drawer in this.drawers) {
                this.drawers[drawer] = false;
            }
        },
        move() {
            this.dialog = false;
            this.drawers.item = false;
            if (!this.newContainer || !this.subjectContainer || !this.subject) {
                return;
            }

            let newIndex: number = -1;
            let subjectIndex: number = -1;
            let index: number = 0;
            for (const container of this.containers) {
                if (container.id === this.newContainer.id) {
                    newIndex = index;
                }

                if (container.id === this.subjectContainer.id) {
                    subjectIndex = index;
                }

                index++;
            }

            if (newIndex === -1 || subjectIndex === -1) {
                return;
            }

            let itemIndex = this.inventory.containers[subjectIndex].items.indexOf(this.subject);

            this.inventory.containers[newIndex].items.push(this.subject);
            this.inventory.containers[subjectIndex].items.splice(itemIndex, 1);
            this.update();
        },
        addNewContainer() {
            this.inventory.containers.push({
                id: uuidv4(),
                name: '',
                items: [],
            });

            this.update();
        },
        removeContainer(container: IContainer) {
            let index = this.inventory.containers.indexOf(container);
            this.inventory.containers.splice(index, 1);
            this.update();
        },
        add(data: App.Models.Character.Item) {
            if (!this.subjectContainer) {
                return;
            }

            let item: InventoryItem = new InventoryItem(data, this.repository);
            let subjectIndex: number = -1;
            let index: number = 0;
            for (const container of this.containers) {
                if (container.id === this.subjectContainer.id) {
                    subjectIndex = index;
                }

                index++;
            }

            this.inventory.containers[subjectIndex].items.push(item);
            this.update();
        },
    },
    computed: {
        containers(): IContainer[] {
            let containers: IContainer[] = [];
            this.inventory.containers.forEach((container: IContainer) => {
                let proxy: IContainer = { ...container };
                proxy.items = [];

                container.items.forEach((item: IInventoryItem) => {
                    if (!item.shouldRemove) {
                        proxy.items.push(item);
                    }
                });

                containers.push(proxy);
            });

            return containers;
        },
    },
});
</script>

<style lang="scss" scoped>
.q-table--dense .q-table q.-th,
.q-table--dense .q-table .q-td {
    &.quantity-row {
        padding-left: calc(50% - 100px);
    }
}
</style>
