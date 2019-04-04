<template>
    <div class="card mb-3">
        <div class="card-header d-flex flex-row align-items-center">
            <h5 class="flex-grow-1 m-0">
                {{ this.title }}
            </h5>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="limitUnitsToInventory"
                           name="limitUnitsToInventory" @change="this.checkboxChanged" v-model="this.limitToInventory">
                    <label class="form-check-label" for="limitUnitsToInventory">
                        Limit units to inventory
                    </label>
                </div>
            </div>
        </div>

        <div class="card-body">
            <keep-alive>
                <component v-bind:is="listComponent" v-bind="getListProps()"></component>
            </keep-alive>
        </div>
    </div>
</template>

<script>

    import {EventBus} from "../EventBus";
    import InventoryComponent from "./InventoryComponent";
    import AllUnitsComponent from "./AllUnitsComponent";

    export default {
        components: {InventoryComponent, AllUnitsComponent},

        props: {
            title: {
                default: '',
                type: String
            },
            factions: {
                type: Object,
                default: function () {
                    return {};
                }
            },
            armyId: {
                default: null,
                type: Number
            },
            limitToInventory: {
                default: false,
                type: Boolean
            }
        },

        computed: {
            listComponent() {
                if (this.listType.d === 'inventory') {
                    return "InventoryComponent";
                } else if (this.listType.d === 'standard') {
                    return "AllUnitsComponent";
                }

                return null;
            }
        },

        /*
         * The component's data.
         */
        data() {
            return {
                listType: {
                    d: 'inventory'
                }
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
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.$set(this.listType, 'd', this.limitToInventory ? 'inventory' : 'standard');
            },

            getListProps() {
                if (this.listType.d === 'standard') {
                    return {
                        showActions: true,
                        armyId: this.armyId,
                        factions: this.factions
                    };
                } else if (this.listType.d === 'inventory') {
                    return {
                        type: 'army',
                        armyId: this.armyId,
                        factions: this.factions
                    };
                }

                return null;
            },

            checkboxChanged() {
                if (this.listType.d === 'inventory') {
                    this.$set(this.listType, 'd', 'standard');
                } else {
                    this.$set(this.listType, 'd', 'inventory');
                }
            }
        }
    }
</script>
