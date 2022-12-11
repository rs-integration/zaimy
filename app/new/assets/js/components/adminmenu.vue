<template>
    <div class="left-menu">
        <div v-for="menuPoint in menuPoints" class="menu-point-wrapper">
            <a class="menu-point" v-on:click="action(menuPoint.action)">{{ menuPoint.label }}</a>
        </div>
    </div>
</template>

<script>
    var adminCurrentAction = "site-settings";
    export default {
        name: "adminmenu",
        data() {
            return {
                menuPoints: window.menuPoints ?? []
            }
        },
        methods: {
            action: function (action) {
                let adminmain = this.$parent.$children.find(function (elem) {
                    return elem.$options._componentTag === 'adminmain';
                });

                if (adminmain) {
                    adminmain.changeAction(action);
                }
            }
        }
    }
</script>

<style scoped>

</style>
