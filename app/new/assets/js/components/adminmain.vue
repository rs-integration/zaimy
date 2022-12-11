<template>
    <div class="admin-main">
        <component :is="currentAction" :editmode="true"></component>
        <admin-right-buttons />
    </div>
</template>

<script>
    import siteSettings from "./siteSettings";
    import organizations from "./organizations";
    import orgEdit from "./orgEdit";
    import adminRightButtons from "./adminRightButtons";

    export default {
        name: "adminmain",
        data() {
            return {
                currentAction: localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ACTION)
            }
        },
        components: {adminRightButtons, siteSettings, organizations, orgEdit},
        methods: {
            changeAction: function (action) {
                this.currentAction = action;
                localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ACTION, action);
            },
            reload: function () {
                let action = this.currentAction;
                this.changeAction();
                setTimeout(
                    function () {
                        this.changeAction(action);
                    }.bind(this), 100
                )

            },
            createEntity: function () {
                switch (this.currentAction) {
                    case 'org-edit':
                        this.changeAction();
                    case 'organizations':
                        setTimeout(
                            function () {
                                localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ORGEDIT_CREATE_ENTITY, 'true');
                                localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID, undefined);
                                this.changeAction('org-edit');
                            }.bind(this), 1
                        )
                        break;
                    case 'site-settings':
                    default:
                        alert('later');
                        break;

                }
            }
        }
    }
</script>

<style scoped>

</style>
