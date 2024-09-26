<template>
    <div>
        <transition name="fade">
            <div v-if="successMessage || failMessage" class="mt-4 h-10 text-center pt-2 text-indigo-400 bg-white/10 shadow-lg rounded-lg font-semibold">
                {{ successMessage }}
                {{ failMessage }}
            </div>
        </transition> 
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style>
    
</style>