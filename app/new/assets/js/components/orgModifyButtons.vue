<template>
    <div class="org-edit-buttons">
        <div
            class="move-left"
            style=""
            v-on:click="moveLeft()"
            v-if="index > 0"
        ></div><div class="org-edit" @click.prevent="edit()">✎</div><!--
        --><div
            class="move-right"
            style=""
            v-on:click="moveRight()"
            v-if="index + 1 < this.$parent.$parent.organizationsList.length"
        ></div>
    </div>
</template>

<script>
    export default {
        name: "orgModifyButtons",
        props: ['orgKey', 'index'],
        methods: {
            moveLeft: function () {
                array_move(
                    this.$parent.$parent.organizationsList,
                    this.index,
                    this.index - 1,
                )
                this.saveSorting();
            },
            moveRight: function () {
                array_move(
                    this.$parent.$parent.organizationsList,
                    this.index,
                    this.index + 1,
                )
                this.saveSorting();
            },
            edit: function () {
                localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ORGEDIT_CREATE_ENTITY, 'false');
                localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID, this.$parent.organization.id);
                let main = this.$parent.$parent.$parent;
                main.changeAction('org-edit');
            },
            saveSorting: function () {
                this.$parent.$parent.saveSorting();
            }
        }
    }
</script>

<style scoped>

</style>
