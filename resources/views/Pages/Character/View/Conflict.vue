<template>
    <div class="row">
        <q-card class="no-border-radius col-12 q-mb-xs">
            <q-card-section class="row">
                <div class="q-pa-xs col-6">
                    <q-input label="Endurance" dense square filled v-model="endurance" disable />
                </div>
                <div class="q-pa-xs col-6">
                    <q-input label="Fatigue" dense square filled v-model="character.stats.conflict.fatigue" type="number" @update:model-value="update" />
                </div>

                <div class="q-pa-xs col-6">
                    <q-input label="Composure" dense square filled v-model="composure" disable />
                </div>
                <div class="q-pa-xs col-6">
                    <q-input label="Strife" dense square filled v-model="character.stats.conflict.strife" type="number" @update:model-value="update" />
                </div>

                <div class="q-pa-xs col-6">
                    <q-input label="Focus" dense square filled v-model="focus" disable />
                </div>

                <div class="q-pa-xs col-6">
                    <q-input label="Vigilance" dense square filled v-model="vigilance" disable />
                </div>

                <div class="q-pa-xs col-6">
                    <q-input label="Void Points Max" dense square filled v-model="maxVoidPoints" disable />
                </div>
                <div class="q-pa-xs col-6">
                    <q-input
                        label="Void Points Current"
                        dense
                        square
                        filled
                        v-model="character.stats.conflict.void_points"
                        type="number"
                        @update:model-value="update"
                    />
                </div>
            </q-card-section>
        </q-card>

        <q-card class="no-border-radius col-12 q-mb-xs">
            <q-table :rows="weapons" dense />
        </q-card>

        <q-card class="no-border-radius col-12 q-mb-xs">
            <q-table :rows="armors" dense />
        </q-card>

        <q-card class="no-border-radius col-12 q-mb-xs">
            <q-table :rows="martialSkills" dense hide-bottom :pagination="{ rowsPerPage: 10 }" />
        </q-card>
    </div>
</template>

<script lang="ts">
import { Character } from '@/ts/Character/View/Character';
import { SaveManager } from '@/ts/Character/View/SaveManager';
import { InventoryItem } from '@/ts/Inventory/InventoryItem';
import { ItemRepository } from '@/ts/Repositories/ItemRepository';
import { SkillRepository } from '@/ts/Repositories/SkillRepository';
import { defineComponent, PropType, ref } from 'vue';

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
        const inventory = ref<IInventory>({
            containers: [],
        });

        const skills = ref<SkillRepository>(new SkillRepository());
        await skills.value.init();

        const repository = new ItemRepository();
        await repository.init();

        props.character.inventory.containers.forEach((container: IContainer) => {
            let proxyContainer: IContainer = {
                id: container.id,
                name: container.name,
                items: [],
            };

            container.items.forEach((item: IInventoryItem) => {
                let proxyItem: InventoryItem = new InventoryItem(item.item_key, repository);
                proxyItem.quantity = item.quantity;
                proxyItem.custom_name = item.custom_name;

                proxyContainer.items.push(proxyItem);
            });

            inventory.value.containers.push(proxyContainer);
        });

        return { inventory, skills };
    },

    methods: {
        update() {
            this.saveManager.saveStats(this.character);
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
        maxVoidPoints() {
            return this.character.stats.rings.void;
        },
        weapons() {
            let weapons: Object[] = [];
            for (const container of this.inventory.containers) {
                for (const inventoryItem of container.items) {
                    let item = inventoryItem.getItem();
                    if (item.item_subtype?.item_type?.key === 'weapon') {
                        let data = item.data as WeaponData;
                        let weapon = {
                            name: inventoryItem.getName(),
                            skill: this.skills.fromKey(data.skill_key).name,
                            range: '',
                            dmg: data.damage,
                            dls: data.deadliness,
                            grips: '',
                        };

                        let range = data.range.min.toString();
                        if (data.range.min !== data.range.max) {
                            range += ` - ${data.range.max}`;
                        }

                        weapon.range = range;

                        let grips: string[] = [];
                        for (const [key, grip] of Object.entries(data.grips)) {
                            let title = `${key}-hand`;
                            if (parseInt(key) > 1) {
                                title += 's';
                            }

                            grips.push(`${title}: ${grip}`);
                        }

                        weapon.grips = grips.join(', ');

                        weapons.push(weapon);
                    }
                }
            }

            return weapons;
        },
        armors() {
            let armors: Object[] = [];
            for (const container of this.inventory.containers) {
                for (const inventoryItem of container.items) {
                    let item = inventoryItem.getItem();
                    if (item.item_subtype?.item_type?.key === 'armor') {
                        let data = item.data as ArmorData;
                        let armor = {
                            name: inventoryItem.getName(),
                            physical_resistance: data.physical,
                            supernatural_resistance: data.supernatural,
                        };

                        armors.push(armor);
                    }
                }
            }

            return armors;
        },

        martialSkills() {
            let data: Object[] = [];
            const characterSkills = this.character?.stats?.skills ?? {};
            const groups = this.skills.bySkillGroup();
            for (const [key, skills] of Object.entries(groups)) {
                if (key !== 'Martial') {
                    continue;
                }

                skills.forEach((skill) =>
                    data.push({
                        skill: skill.name,
                        rank: characterSkills[skill.key] ?? 0,
                    })
                );
            }

            return data;
        },
    },
});
</script>

<style lang="scss" scoped>
.q-avatar {
    margin: 6px 6px 0px;
}
</style>
