<template>
    <div class="organizations-wrapper" v-if="this.organizationsList.length > 0">
        <organization
            v-for="(organization, index) in this.organizationsList"
            :key="organization.id"
            :organization="organization"
            :editmode="editmode"
            :index="index"
        />
    </div>
</template>

<script>
    import axios from "axios";
    import organization from "./organization";

    export default {
        data() {
            return {
                organizationsList: []
            }
        },
        props: ['editmode'],
        name: "organizations",
        mounted() {
            axios.get('/api/organizations').then(
                response => {
                    if (response.data && Array.isArray(response.data)) {
                        this.organizationsList = response.data.sort(
                            (a, b) => a.sort - b.sort
                        );
                    } else {
                        alert('unknown response');
                        console.log(response);
                    }

                    // TODO: loader_off
                }, response => {
                    alert('get organizations failed');
                    console.log(response);

                    // TODO: loader_off
                }
            );
        },
        components: {organization},
        methods: {
            saveSorting: function () {
                let request = [];

                for (let newSort in this.organizationsList) {
                    if (!this.organizationsList.hasOwnProperty(newSort)) continue;

                    request.push({
                        'id': this.organizationsList[newSort].id,
                        'sort': newSort,
                    });
                }

                axios.post('/api/organizations/batch', request).then(
                    response => {
                        console.log('sort updated successfully');
                    }, response => {
                        alert('error on updating sort');
                        console.log(response, request, this.organizationsList);
                    }
                );
            },
        },
    }
</script>

<style scoped>

</style>
