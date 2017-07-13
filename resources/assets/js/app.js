import './bootstrap';
import router from './router';
import store from './store/index';
import { sync } from 'vuex-router-sync';
import Application from './Application';


sync(store, router);



const app = new Vue({
    components: { Application },
    el: '#app',
    router,
    store,
});
