<template>
    <transition name="success">
        <div v-if="success" id="toast-success" class="flex items-center p-4 mb-4 text-gray-500 bg-black rounded-lg ring-2 ring-indigo-400 shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm text-white font-normal">{{ success }}</div>
            <button @click.prevent="removeToast" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-indigo-400 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </transition>
</template>

<script>
    export default {
        data() {
            return {
                success: null
            }
        },
        mounted() {
            this.getMessage()
        },

        methods: {
            getMessage() {
                if (this.$parent.$parent.successMessage !== null) {
                   this.success = this.$parent.$parent.successMessage
                   setTimeout( () => this.success = null , 3000)
                }
            },

            removeToast() {
                this.success = null
            }
        },
    }
</script>

<style>
    .success-enter-from,
    .success-leave-to {
        transform: translateX(100%);
        opacity: 0;
    }
    .success-enter-active,
    .success-leave-active  {
        transition: all 500ms ease;
    }
    .success-enter-to,
    .success-leave-from {
        opacity: 1;
    }
</style>