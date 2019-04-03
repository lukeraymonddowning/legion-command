<template>
    <button
            class="btn btn-outline-success"
            v-on:click="addToInventory"
    >Add to inventory
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
            addToInventory() {
                axios.put(`/api/user/inventory/${this.unitId}`)
                    .then(response => {
                        EventBus.$emit('inventory-edited')
                    });
            }
        }
    }
</script>
