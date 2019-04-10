<template>
    <div class="position-fixed" style="bottom: 16px; left: 16px; right: 16px;">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div v-bind:class="this.regularClasses + ' ' + this.displayClass.d" style="pointer-events: none;">
                    {{ this.message.d }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {EventBus} from "../EventBus";

    export default {
        /*
         * The component's data.
         */

        data() {
            return {
                message: {
                    d: ""
                },
                displayClass: {
                    d: "d-none"
                },
                regularClasses: 'alert alert-info shadow-lg'
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
            EventBus.$on('show-message', ($message) => {
                this.show($message);
            });
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            show(message) {
                this.$set(this.message, 'd', message);
                this.$set(this.displayClass, 'd', 'show');
                setTimeout(() => {
                    this.$set(this.displayClass, 'd', 'hide');
                }, 2000);
            }
        }
    }
</script>
