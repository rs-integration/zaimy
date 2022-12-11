<template>
    <form id="site_settings" method="post" @submit.prevent="saveSettings">
        <div class="options-list">
            <label for="site_title">Имя сайта</label><input type="text" id="site_title" name="site_title" v-model="settings.site_title"><br>
            <label for="site_description">Описание сайта</label><textarea id="site_description" name="site_description" v-model="settings.site_description"></textarea>
        </div>
        <div class="save-button"><input type="submit" value="Сохранить" style="height: 60px;" :disabled="disabled"></div>
    </form>
</template>

<script>
    window.siteSettings = {
        site_title: '',
        site_description: '',
    };

    import axios from 'axios';

    export default {
        name: "siteSettings",
        props: ['editmode'],
        data() {
            return {
                settings: window.siteSettings,
                disabled: true,
            }
        },
        methods: {
            saveSettings: function () {
                axios.post('/api/site-settings', this.settings)
                    .then(
                    response => {
                        alert('success');

                        if (Array.isArray(response.data)) {
                            for (const setting of response.data) {
                                if (window.siteSettings.hasOwnProperty(setting.name)) {
                                    window.siteSettings[setting.name] = setting.value;
                                }
                            }
                        }
                    }, response => {
                        alert('fail')
                        console.log(1, response)
                    }
                );
            }
        },
        mounted() {
            // TODO: loader_on
            this.disabled = true;
            axios.get('/api/site-settings').then(
                response => {
                    if (response.data && Array.isArray(response.data)) {
                        for (const setting of response.data) {
                            this.settings[setting.name] = setting.value
                        }
                    } else {
                        alert('unknown response');
                        console.log(response);
                    }

                    // TODO: loader_off
                    this.disabled = false;
                }, response => {
                    alert('get settings failed');
                    console.log(response);

                    // TODO: loader_off
                    this.disabled = false;
                }
            );
        }
    }
</script>

<style scoped>

</style>
