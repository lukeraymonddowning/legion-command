<template>
    <div class="row">
        <div v-for="(item, index) in unit_roster" class="col-12 col-lg-6 mb-3 mb-lg-4 d-flex flex-column flex-lg-column-reverse">
            <div class="d-flex flex-row flex-lg-column-reverse align-items-center mt-lg-3">
                <span class="flex-grow-1 mt-lg-2">{{ item.unit.name }}</span>
                <remove-from-army-button v-bind:army-id="armyId" v-bind:unit-id="item.unit.id"></remove-from-army-button>
            </div>
            <img class="img-fluid mt-2 w-100" v-bind:src="item.unit.unit_card_image_asset_url"/>

        </div>
    </div>
</template>

<script>

    import {EventBus} from "../EventBus";
    import RemoveFromInventoryButtonComponent from "./RemoveFromInventoryButtonComponent";
    import RemoveFromArmyButtonComponent from "./RemoveFromArmyButtonComponent";

    export default {
        components: {RemoveFromArmyButtonComponent, RemoveFromInventoryButtonComponent},

        props: {
            showActions: {
                default: true,
                type: Boolean
            },
            armyId: {
                type: Number
            },
            faction: {
                type: Object
            }
        },

        /*
         * The component's data.
         */
        data() {
            return {
                unit_roster: []
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
            EventBus.$on('army-units-edited', ($army_id) => {
                this.getArmy($army_id);
            });
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getArmy(this.armyId);
            },

            getArmy(armyId) {
                if (armyId === null)
                    return;

                axios.get(`/api/user/armies/${armyId}`)
                    .then(response => {
                        this.unit_roster = response.data;
                    });
            }
        }
    }
</script>
