import './styles/client-app.css';

// start the Stimulus application
import './bootstrap';

import Vue from 'vue';
import mainHeader from "./js/components/mainHeader";
import mainContent from "./js/components/mainContent";
import mainFooter from "./js/components/mainFooter";
import notificationsAndModals from "./js/components/notificationsAndModals";

var client_app = new Vue({
    el: '#index_app',
    delimiters: ['${', '}$'],
    data() {
        return {
            test: 'ddddd'
        }
    },
    components: {
        mainHeader,
        mainContent,
        mainFooter,
        notificationsAndModals,
    },
});
