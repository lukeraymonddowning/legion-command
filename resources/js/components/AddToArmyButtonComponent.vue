<template>
    <button
            class="btn btn-outline-success"
            v-on:click="addToArmy"
    >Add to army
    </button>
</template>

<script>

    import {EventBus} from "../EventBus";

    export default {
        /*
         * The component's data.
         */
        props: ['unitId', 'armyId'],

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
            addToArmy(e) {
                e.preventDefault();
                axios.put(`/api/user/armies/${this.armyId}/${this.unitId}`)
                    .then(response => {
                        EventBus.$emit('army-units-edited', this.armyId);
                    });
            }
        }
    }
</script>
