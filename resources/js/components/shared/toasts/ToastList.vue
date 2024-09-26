<template>
    <Teleport to="body">
        <div class="fixed top-4 right-4 z-50 w-full max-w-xs">
            <SuccessToast ref="s" />
            <!-- <DangerToast ref="d" /> -->
        </div>
    </Teleport>
</template>

<script>
    import { Teleport } from 'vue';
    import DangerToast from './DangerToast.vue';
    import SuccessToast from './SuccessToast.vue';
    export default {
        components: {
            SuccessToast,
            DangerToast,
            Teleport
        }
}
</script>

<style>

</style>