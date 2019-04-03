<template>
    <div class="row">
        <div v-if="isFactionAllowed(item.unit)" v-for="item in inventory" class="col-12 col-lg-6 mb-3 mb-lg-4 d-flex flex-column flex-lg-column-reverse">
            <div class="d-flex flex-row flex-lg-column-reverse align-items-center mt-lg-3">
                <span class="flex-grow-1 mt-lg-2"><b>{{ item.unit_count }}x</b> {{ item.unit.name }}</span>
                <component v-bind:is="actionComponent" v-bind="getActionProps(item)"></component>
            </div>
            <img class="img-fluid mt-2 w-100" v-bind:src="item.unit.unit_card_image_asset_url"/>
        </div>
    </div>
</template>

<script>

    import {EventBus} from "../EventBus";
    import RemoveFromInventoryButtonComponent from "./RemoveFromInventoryButtonComponent";
    import AddToArmyButtonComponent from "./AddToArmyButtonComponent";

    export default {
        components: {RemoveFromInventoryButtonComponent, AddToArmyButtonComponent},

        props: {
            showActions: {
                default: true,
                type: Boolean
            },
            type: {
                default: 'inventory',
                type: String
            },
            factions: {
                type: Object,
                default: function() {
                    return {};
                }
            },
            armyId: {
                default: null,
                type: Number
            }
        },

        computed: {
            actionComponent()  {
                if (this.showActions === false)
                    return null;

                if (this.type === 'inventory') {
                    return "RemoveFromInventoryButtonComponent";
                } else if (this.type === 'army') {
                    return "AddToArmyButtonComponent";
                }

                return null;
            }
        },

        /*
         * The component's data.
         */
        data() {
            return {
                inventory: []
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
            EventBus.$on('inventory-edited', () => {
                this.getInventory();
            });
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getInventory();
            },

            /**
             * Get all of the authorized tokens for the user.
             */
            getInventory() {
                axios.get('/api/user/inventory')
                    .then(response => {
                        this.inventory = response.data;
                    });
            },

            isFactionAllowed(unit) {
                // Turn the factions object into an array
                const factions_array = Object.keys(this.factions).map((k) => this.factions[k]);

                // If the array is empty, it means we want to show all factions
                if (factions_array.length === 0)
                    return true;

                // Then check if the unit's faction is in the allowed faction array
                return factions_array.map(faction_obj => faction_obj.id).includes(unit.faction);
            },

            getActionProps(item) {
                if (this.showActions === false)
                    return null;

                if (this.type === 'inventory') {
                    return {
                        unitId: item.unit.id
                    };
                } else if (this.type === 'army') {
                    return {
                        unitId: item.unit.id,
                        armyId: this.armyId
                    };
                }

                return null;
            },

            getEmptyArray() {
                return [];
            }
        }
    }
</script>
