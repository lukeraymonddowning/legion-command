<template>
    <button
            class="btn btn-outline-danger"
            v-on:click="removeFromInventory"
    >Remove from inventory
    </button>
</template>

<script>

    import {EventBus} from "../EventBus";

    export default {
        /*
         * The component's data.
         */
        props: ['unitId'],

        data() {
            return {};
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
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            removeFromInventory() {
                axios.delete(`/api/user/inventory/${this.unitId}`)
                    .then(response => {
                        EventBus.$emit('inventory-edited')
                    });
            }
        }
    }
</script>
