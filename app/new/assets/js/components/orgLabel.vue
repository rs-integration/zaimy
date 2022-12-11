<template>
    <div v-if="label">
        <div class="parallelogram__left-angle" style="border-bottom-color: #FF4242"></div><div class="parallelogram" style="background: #FF4242">
        <span>{{ label }}</span>
</div><div class="parallelogram__right-angle" style="border-top-color: #FF4242">

    </div>
    </div>
</template>

<script>
    export default {
        name: "orgLabel",
        props: ['label']
    }
</script>

<style scoped>

</style>
