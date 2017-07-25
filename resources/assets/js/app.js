import './bootstrap';
import router from './router';
import store from './store/index';
import { sync } from 'vuex-router-sync';
import Application from './Application';
import Loading from './components/Loading';


sync(store, router);

Vue.component('w-loading', Loading);

const app = new Vue({
    components: { Application, },
    el: '#app',
    router,
    store,
});
