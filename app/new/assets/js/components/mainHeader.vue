<template>
    <div class="main-header">
        <banner-header></banner-header>
        <introduction-header></introduction-header>
    </div>
</template>

<script>
    import bannerHeader from "./bannerHeader";
    import introductionHeader from "./introductionHeader";

    export default {
        name: "mainHeader",
        components: {bannerHeader, introductionHeader},
    }
</script>

<style scoped>

</style>
