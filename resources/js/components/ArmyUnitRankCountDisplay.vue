<template>
    <div class="d-flex flex-row justify-content-around mb-4 flex-wrap px-2">
        <div v-for="(rankData, rankId) in rankCounts.d" class="d-flex flex-column align-items-center mx-2 mb-2">
            <span v-bind:class="(rankData.count || 0) < rankData.minimum || (rankData.count || 0) > rankData.allowance ? 'text-danger font-weight-bold' : ''">{{ rankData.name }}</span>
            <span v-bind:class="(rankData.count || 0) < rankData.minimum || (rankData.count || 0) > rankData.allowance ? 'text-danger font-weight-bold' : ''">{{ rankData.count || 0 }}/{{ rankData.allowance }}</span>
        </div>
    </div>
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
                rankCounts: {
                    d: {}
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
            this.fetchRankCounts();
            EventBus.$on('army-units-edited', ($army_id) => {
                this.fetchRankCounts();
            });
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            fetchRankCounts() {
                axios.get(`/api/user/armies/${this.armyId}/rank`)
                    .then(response => {
                        this.$set(this.rankCounts, 'd', response.data);
                    });
            }
        }
    }
</script>
