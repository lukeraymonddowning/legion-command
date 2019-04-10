<template>
    <div class="row">
        <div v-if="isFactionAllowed(item) && (!item.unique || findUnitsUsedInstances(item.id) === 0)"
             v-for="item in units.d" class="col-12 col-xl-4 col-md-6 mb-3 mb-lg-4 d-flex flex-column flex-md-column-reverse">
            <div class="d-flex flex-row flex-md-column-reverse align-items-center mt-md-3">
                <span class="flex-grow-1 mt-md-2">{{ item.name }}</span>
                <add-to-army-button v-bind:unit-id="item.id" v-bind:army-id="armyId" v-bind:unit-name="item.name"></add-to-army-button>
            </div>
            <img class="img-fluid mt-2 w-100" v-bind:src="item.unit_card_image_asset_url"/>
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

        },

        computed: {

        },

        /*
         * The component's data.
         */
        data() {
            return {
                unitsUsed: {
                    d: []
                },
                units: {
                    d: []
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
            EventBus.$on('army-units-edited', ($army_id) => {
                this.getArmy($army_id);
            });
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getUnits();
                if (this.armyId !== null)
                    this.getArmy(this.armyId);
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

            findUnitsUsedInstances(unit_id) {

                const counts = {};

                for (var i = 0; i < this.unitsUsed.d.length; i++) {
                    var num = this.unitsUsed.d[i];
                    counts[num] = counts[num] ? counts[num] + 1 : 1;
                }

                return counts.hasOwnProperty(unit_id) ? counts[unit_id] : 0;
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

            getUnits() {
                axios.get(`/api/factions/${this.factions[0].id}`).then(response => {
                    this.$set(this.units, 'd', response.data[0].units);
                });
            },

            getArmy(armyId) {
                if (armyId === null)
                    return;

                axios.get(`/api/user/armies/${armyId}/simple`)
                    .then(response => {
                        this.$set(this.unitsUsed, 'd', response.data);
                    });
            }
        }
    }
</script>
