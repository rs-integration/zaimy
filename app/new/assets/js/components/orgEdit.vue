<template>
    <div class="organization-edit-wrapper">
        <form id="org_edit" method="post" @submit.prevent="createOrUpdate">
            <div class="org-form-fields">
            <template v-for="(value, name) in organization">
                <label :for="getEditorFieldHtmlId(name)">{{ORGANIZATION_FIELD_PARAMS[name].name}}</label>
                <input
                    v-if="ORGANIZATION_FIELD_PARAMS[name].tag === 'input'"
                    :id="getEditorFieldHtmlId(name)"
                    v-model="organization[name]"
                    :readonly="ORGANIZATION_FIELD_PARAMS[name].readonly"
                    :type="ORGANIZATION_FIELD_PARAMS[name].type"
                />
            </template>
            </div>
            <div class="save-button"><input type="submit" value="Сохранить" style="height: 60px;" :disabled="this.disabled"></div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "orgEdit",
        props:['editmode'],
        data() {
            return {
                organization: undefined,
                ORGANIZATION_FIELD_PARAMS: ORGANIZATION_FIELD_PARAMS,
                disabled: false,
            }
        },
        mounted() {
            if (localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ORGEDIT_CREATE_ENTITY) === 'false') {
                this.disabled = true;

                let timer = setInterval(
                    function () {

                        if (localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ACTION) !== 'org-edit') {
                            clearInterval(timer);

                            return;
                        }

                        if (!localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID)) {
                            return;
                        } else {
                            clearInterval(timer);

                            axios.get('/api/organizations/' + localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID)).then(
                                response => {
                                    this.organization = response.data;

                                    this.disabled = false;
                                }, response => {
                                    alert('error on loading organization');
                                    console.log(response, localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID))
                                }
                            )
                        }
                    }.bind(this),
                    100
                );
            } else {
                this.organization = {
                    id: undefined,
                    name: '',
                    link: '',
                    logo: '',
                    label: '',
                    maxSumm: 0,
                    minPercent: 0,
                    minAge: 0,
                    maxAge: 0,
                    sort: undefined
                };
                this.disabled = false;
            }
        },
        methods: {
            getEditorFieldHtmlId: function (name) {
                return 'org_edit_' + name;
            },
            createOrUpdate: function () {
                this.disabled = true;
                axios.put('/api/organizations', this.trimRequest()).then(
                    response => {
                        this.organization = response.data;

                        localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ORGEDIT_CREATE_ENTITY, 'false');
                        localStorage.setItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID, this.organization.id);

                        this.disabled = false;
                    }, response => {
                        alert('error on loading organization');
                        console.log(
                            response,
                            localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ORGEDIT_CREATE_ENTITY),
                            localStorage.getItem(LOCALSTORAGE_SAVE_KEY_ORGANIZATION_ID)
                        )
                    }
                );
            },
            trimRequest: function () {
                let request = {};
                if (!this.organization) return request;

                for (const fieldName in this.organization) {
                    if (!this.organization.hasOwnProperty(fieldName)) continue;

                    if (fieldName !== 'id'
                        && (!ORGANIZATION_FIELD_PARAMS[fieldName]
                        || ORGANIZATION_FIELD_PARAMS[fieldName].readonly === true)
                    ) continue;

                    request[fieldName] = this.organization[fieldName];
                }

                return request;
            }
        }
    }
</script>

<style scoped>

</style>
