<template>
    <span>{{ cost.d }}</span>
</template>

<script>

    import {EventBus} from "../EventBus";

    export default {
        /*
         * The component's data.
         */
        props: ['armyId'],

        data() {
            return {
                cost: {
                    d: 0
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
            this.getCost();
            EventBus.$on('army-units-edited', ($army_id) => {
                this.getCost();
            });
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            getCost() {
                axios.get(`/api/user/armies/${this.armyId}/points`)
                    .then(response => {
                        this.$set(this.cost, 'd', response.data);
                    });
            }
        }
    }
</script>
