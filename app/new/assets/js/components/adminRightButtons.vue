<template>
    <div class="right-buttons">
        <div class="reload" v-on:click="reload()"> 🔃</div>
        <div class="create-entity" v-on:click="createEntity()">⨁</div>
    </div>
</template>

<script>
    export default {
        name: "adminRightButtons",
        methods: {
            reload: function () {
                this.$parent.reload();
            },
            createEntity: function () {
                this.$parent.createEntity();
            }
        }
    }
</script>

<style scoped>

</style>
